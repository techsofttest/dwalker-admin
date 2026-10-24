<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'text', 'auth_security', 'windcave'));
        $this->load->model('Admin_model');
        $this->load->driver('cache', array('adapter' => 'file'));

        // Set JSON Content Type & CORS
        $this->output->set_content_type('application/json');
    }

    private function response($data, $status_code = 200) {
        $this->output
             ->set_status_header($status_code)
             ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Common bot defense validator: checks honeypot trap, speed, and IP rate limits
     */
    private function is_bot_submission($post, $rate_prefix, $max_attempts = 10, $decay_seconds = 600) {
        // 1. Honeypot check: Bots fill hidden/decoy fields
        $hp_values = array(
            isset($post['website_url']) ? trim($post['website_url']) : '',
            isset($post['hp_field']) ? trim($post['hp_field']) : '',
            isset($post['company_fax']) ? trim($post['company_fax']) : ''
        );
        foreach ($hp_values as $hp) {
            if (!empty($hp)) {
                return true; // Trap triggered
            }
        }

        // 2. Submission speed check: Bots submit instantaneously
        if (isset($post['form_rendered_at']) && is_numeric($post['form_rendered_at'])) {
            $timeTaken = time() - (int)$post['form_rendered_at'];
            if ($timeTaken < 1) {
                return true; // Unnaturally fast
            }
        }

        // 3. IP rate limiting
        $ip = $this->input->ip_address();
        $rate_key = $rate_prefix . '_' . md5($ip);
        $attempts = (int)$this->cache->file->get($rate_key);
        if ($attempts >= $max_attempts) {
            return 'rate_limited';
        }
        $this->cache->file->save($rate_key, $attempts + 1, $decay_seconds);

        return false;
    }


    private function get_image_url($folder, $filename) {
        if (empty($filename)) {
            return rtrim(base_url(), '/') . '/uploads/placeholder.jpg';
        }   
        if (strpos($filename, 'http://') === 0 || strpos($filename, 'https://') === 0) {
            return $filename;
        }
        return rtrim(base_url(), '/') . '/uploads/' . trim($folder, '/') . '/' . ltrim($filename, '/');
    }

    // ------------------------------------------------------------------------
    // 1. CATEGORIES & TAXONOMY API
    // ------------------------------------------------------------------------
    public function categories() {
        $categories = $this->db->get('dwalker_category')->result_array();

        foreach ($categories as &$cat) {
            $cat['image_url'] = $this->get_image_url('Category', $cat['cat_image']);
            
            // Fetch Subcategories
            $subcategories = $this->db->get_where('dwalker_subcategory', array('cat_id' => $cat['cat_id']))->result_array();

            foreach ($subcategories as &$subcat) {
                // Fetch Sub-subcategories
                $subcatsubs = $this->db->get_where('dwalker_subcategorysub', array('subcat_id' => $subcat['subcat_id']))->result_array();

                foreach ($subcatsubs as &$subcatsub) {
                    $subcatsub['image_url'] = $this->get_image_url('subcategory', $subcatsub['image']);
                }

                $subcat['children'] = $subcatsubs;
            }

            $cat['subcategories'] = $subcategories;
        }

        $this->response(array(
            'status' => 'success',
            'data' => $categories
        ));
    }

    // ------------------------------------------------------------------------
    // 2. COLLECTIONS API
    // ------------------------------------------------------------------------
    public function collections() {
        

        foreach ($collections as &$col) {
            if (empty($col['SlugName'])) {
                $col['SlugName'] = strtolower(url_title($col['collection_name']));
            }
        }

        $this->response(array(
            'status' => 'success',
            'data' => $collections
        ));
    }

    // ------------------------------------------------------------------------
    // 3. PRODUCTS LIST API (Filterable, Searchable, Paginated)      
    // ------------------------------------------------------------------------
    public function products() {
        $category_slug    = $this->input->get('category');
        $subcategory_slug = $this->input->get('subcategory');
        $collection_name  = $this->input->get('collection');
        $gemstone         = $this->input->get('gemstone');
        $color            = $this->input->get('color');
        $search           = $this->input->get('q');
        $sort             = $this->input->get('sort'); // price_asc, price_desc, newest
        $limit            = (int)($this->input->get('limit') ?: 20);
        $page             = (int)($this->input->get('page') ?: 1);
        $offset           = ($page - 1) * $limit;

        $this->db->from('dwalker_product');

        // Apply Category Filter
        if (!empty($category_slug)) {
            $cat = $this->db->get_where('dwalker_category', array('SlugName' => $category_slug))->row_array();
            if ($cat) {
                $this->db->where('cat_id', $cat['cat_id']);
            }
        }

        // Apply Subcategory Filter
        if (!empty($subcategory_slug)) {
            $subcat = $this->db->get_where('dwalker_subcategory', array('SlugName' => $subcategory_slug))->row_array();
            if ($subcat) {
                $this->db->where('subcat_id', $subcat['subcat_id']);
            }
        }

        // Apply Collection Filter
        if (!empty($collection_name)) {
            $this->db->where('productCollection', $collection_name);
        }

        // Apply Gemstone Filter
        if (!empty($gemstone)) {
            $this->db->where('productGemstone', $gemstone);
        }

        // Apply Color Filter
        if (!empty($color)) {
            $this->db->where('productGemcolor', $color);
        }

        // Apply Search Query Filter
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('product_name', $search);
            $this->db->or_like('productCode', $search);
            $this->db->or_like('ProductDesc', $search);
            $this->db->group_end();
        }

        // Only active/non-upcoming products in standard catalog
        $this->db->where('upcoming', 0);

        // Apply Sorting
        if ($sort === 'price_asc') {
            $this->db->order_by('CAST(productPrice AS DECIMAL(10,2))', 'ASC');
        } elseif ($sort === 'price_desc') {
            $this->db->order_by('CAST(productPrice AS DECIMAL(10,2))', 'DESC');
        } elseif ($sort === 'newest') {
            $this->db->order_by('product_id', 'DESC');
        } elseif ($sort === 'order_desc') {
            $this->db->order_by('sort_order', 'DESC');
            $this->db->order_by('product_id', 'DESC');
        } else {
            // Default to custom drag & drop sort_order
            $this->db->order_by('sort_order', 'ASC');
            $this->db->order_by('product_id', 'DESC');
        }

        // Count Total Results
        $total_items = $this->db->count_all_results('', false);

        $this->db->limit($limit, $offset);
        $products = $this->db->get()->result_array();

        // Format Image URLs
        foreach ($products as &$p) {
            $p['image_url'] = $this->get_image_url('Products', $p['ProductImage']);
            $p['default_image_url'] = $this->get_image_url('Products', $p['ProductdefaultImage']);
            if (empty($p['SlugName'])) {
                $p['SlugName'] = strtolower(url_title($p['product_name']));
            }
            $p['price'] = (float)$p['productPrice'];
            $p['original_price'] = (float)$p['productStrikePrice'];
            $p['tax'] = isset($p['productTax']) ? (float)$p['productTax'] : 0.0;
            $p['sort_order'] = isset($p['sort_order']) ? (int)$p['sort_order'] : 0;
            $p['productType'] = !empty($p['productType']) || !empty($p['type']) ? 1 : 0;
            $p['is_featured'] = $p['productType'] === 1;
        }

        $this->response(array(
            'status' => 'success',
            'pagination' => array(
                'total_items' => $total_items,
                'current_page' => $page,
                'per_page' => $limit,
                'total_pages' => ceil($total_items / $limit)
            ),
            'data' => $products
        ));
    }

    // ------------------------------------------------------------------------
    // 4. FEATURED PRODUCTS API
    // ------------------------------------------------------------------------
    public function featured_products() {
        $this->db->from('dwalker_product');
        $this->db->where('upcoming', 0);
        $this->db->group_start();
        $this->db->where('productType', 1);
        $this->db->or_where('productType', '1');
        $this->db->or_where('type', 1);
        $this->db->or_where('type', '1');
        $this->db->group_end();
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('product_id', 'DESC');
        $this->db->limit(8);
        $products = $this->db->get()->result_array();

        foreach ($products as &$p) {
            $p['image_url'] = $this->get_image_url('Products', $p['ProductImage']);
            $p['default_image_url'] = $this->get_image_url('Products', $p['ProductdefaultImage']);
            if (empty($p['SlugName'])) {
                $p['SlugName'] = strtolower(url_title($p['product_name']));
            }
            $p['price'] = (float)$p['productPrice'];
            $p['original_price'] = (float)$p['productStrikePrice'];
            $p['tax'] = isset($p['productTax']) ? (float)$p['productTax'] : 0.0;
            $p['productType'] = !empty($p['productType']) || !empty($p['type']) ? 1 : 0;
            $p['is_featured'] = $p['productType'] === 1;
        }

        $this->response(array(
            'status' => 'success',
            'data' => $products
        ));
    }

    // ------------------------------------------------------------------------
    // 5. NEW ARRIVALS API
    // ------------------------------------------------------------------------
    public function new_arrivals() {
        $this->db->from('dwalker_product');
        $this->db->where('upcoming', 0);
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('product_id', 'DESC');
        $this->db->limit(8);
        $products = $this->db->get()->result_array();

        foreach ($products as &$p) {
            $p['image_url'] = $this->get_image_url('Products', $p['ProductImage']);
            $p['default_image_url'] = $this->get_image_url('Products', $p['ProductdefaultImage']);
            if (empty($p['SlugName'])) {
                $p['SlugName'] = strtolower(url_title($p['product_name']));
            }
            $p['price'] = (float)$p['productPrice'];
            $p['tax'] = isset($p['productTax']) ? (float)$p['productTax'] : 0.0;
            $p['sort_order'] = isset($p['sort_order']) ? (int)$p['sort_order'] : 0;
        }

        $this->response(array(
            'status' => 'success',
            'data' => $products
        ));
    }

    // ------------------------------------------------------------------------
    // UPCOMING PRODUCTS API
    // ------------------------------------------------------------------------
    public function upcoming_products() {
        $this->db->from('dwalker_product');
        $this->db->where('upcoming', 1);
        $this->db->order_by('product_id', 'ASC');
        $products = $this->db->get()->result_array();

        foreach ($products as &$p) {
            $p['image_url'] = $this->get_image_url('Products', $p['ProductImage']);
            $p['default_image_url'] = $this->get_image_url('Products', $p['ProductdefaultImage']);
            if (empty($p['SlugName'])) {
                $p['SlugName'] = strtolower(url_title($p['product_name']));
            }
            $p['price'] = (float)$p['productPrice'];
            $p['original_price'] = (float)$p['productStrikePrice'];
            $p['upcoming'] = 1;
        }

        $this->response(array(
            'status' => 'success',
            'data' => $products
        ));
    }

    // ------------------------------------------------------------------------
    // 6. SINGLE PRODUCT DETAIL API
    // ------------------------------------------------------------------------
    public function product_detail($slug_or_id = null) {
        if (empty($slug_or_id)) {
            $this->response(array('status' => 'error', 'message' => 'Product identifier required'), 400);
            return;
        }

        $this->db->from('dwalker_product');
        if (is_numeric($slug_or_id)) {
            $this->db->where('product_id', $slug_or_id);
        } else {
            $this->db->where('SlugName', $slug_or_id);
        }

        $product = $this->db->get()->row_array();

        if (!$product) {
            $this->response(array('status' => 'error', 'message' => 'Product not found'), 404);
            return;
        }

        $product['image_url'] = $this->get_image_url('Products', $product['ProductImage']);
        $product['default_image_url'] = $this->get_image_url('Products', $product['ProductdefaultImage']);
        $product['price'] = (float)$product['productPrice'];
        $product['original_price'] = (float)$product['productStrikePrice'];
        $product['tax'] = isset($product['productTax']) ? (float)$product['productTax'] : 0.0;

        // Fetch Product Gallery Images from dwalker_productimage
        $gallery_raw = $this->db->get_where('dwalker_productimage', array('product_id' => $product['product_id']))->result_array();
        $gallery = array();
        foreach ($gallery_raw as $g) {
            $gallery[] = $this->get_image_url('Products', $g['ProductImage']);
        }

        $product['gallery'] = $gallery;
        $product['upcoming'] = isset($product['upcoming']) ? (int)$product['upcoming'] : 0;
        $product['productType'] = !empty($product['productType']) || !empty($product['type']) ? 1 : 0;
        $product['is_featured'] = $product['productType'] === 1;

        // Fetch Related Products in same subcategory
        $this->db->from('dwalker_product');
        $this->db->where('subcat_id', $product['subcat_id']);
        $this->db->where('product_id !=', $product['product_id']);
        $this->db->where('upcoming', 0);
        $this->db->limit(4);
        $related = $this->db->get()->result_array();

        foreach ($related as &$rel) {
            $rel['image_url'] = $this->get_image_url('Products', $rel['ProductImage']);
            $rel['price'] = (float)$rel['productPrice'];
        }

        $product['related_products'] = $related;

        $this->response(array(
            'status' => 'success',
            'data' => $product
        ));
    }

    // ------------------------------------------------------------------------
    // 7. SEARCH API
    // ------------------------------------------------------------------------
    public function search() {
        $q = $this->input->get('q');
        if (empty($q)) {
            $this->response(array('status' => 'success', 'data' => array()));
            return;
        }

        $this->db->from('dwalker_product');
        $this->db->group_start();
        $this->db->like('product_name', $q);
        $this->db->or_like('productCode', $q);
        $this->db->group_end();
        $this->db->where('upcoming', 0);
        $this->db->limit(10);
        $results = $this->db->get()->result_array();

        foreach ($results as &$r) {
            $r['image_url'] = $this->get_image_url('Products', $r['ProductImage']);
            $r['price'] = (float)$r['productPrice'];
            $r['tax'] = isset($r['productTax']) ? (float)$r['productTax'] : 0.0;
        }

        $this->response(array(
            'status' => 'success',
            'data' => $results
        ));
    }

    // ------------------------------------------------------------------------
    // 8. PROMO CODE VALIDATION API
    // ------------------------------------------------------------------------
    public function apply_promocode() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $code  = isset($post['code']) ? trim($post['code']) : (isset($post['Promo']) ? trim($post['Promo']) : '');
        $email = isset($post['email']) ? strtolower(trim($post['email'])) : '';

        if (empty($code)) {
            $this->response(array('status' => 'error', 'message' => 'Promo code is required'), 400);
            return;
        }

        // Case-insensitive query for promo code
        $this->db->from('dwalker_promocode');
        $this->db->where('LOWER(code)', strtolower($code));
        $promo = $this->db->get()->row_array();

        if (!$promo) {
            $this->response(array('status' => 'error', 'message' => 'Invalid promo code.'), 404);
            return;
        }

        // Check if status column exists and is active (if status column present)
        if (isset($promo['status']) && (int)$promo['status'] === 0) {
            $this->response(array('status' => 'error', 'message' => 'This promo code is currently inactive.'), 400);
            return;
        }

        $today = date('Y-m-d');

        // Check 'from' date if defined
        if (!empty($promo['from']) && $promo['from'] !== '0000-00-00' && $promo['from'] > $today) {
            $this->response(array('status' => 'error', 'message' => 'This promo code is not active yet.'), 400);
            return;
        }

        // Check 'to' date (expiry) if defined
        if (!empty($promo['to']) && $promo['to'] !== '0000-00-00' && $promo['to'] < $today) {
            $this->response(array('status' => 'error', 'message' => 'This promo code has expired.'), 400);
            return;
        }

        // Check single-use per email in dwalker_usedpromo if email is provided
        if (!empty($email) && $this->db->table_exists('dwalker_usedpromo')) {
            $used = $this->db->get_where('dwalker_usedpromo', array(
                'promocode' => $promo['code'],
                'email'     => $email
            ))->row_array();

            if ($used) {
                $this->response(array('status' => 'error', 'message' => 'This promo code has already been redeemed for this email address.'), 400);
                return;
            }
        }

        $discount_val = isset($promo['discount']) ? (float)$promo['discount'] : 0;
        $type = isset($promo['type']) ? $promo['type'] : 'percentage'; // Admin dwalker_promocode uses discount as percentage (%)

        $this->response(array(
            'status' => 'success',
            'message' => 'Promo code applied successfully!',
            'data' => array(
                'code'            => $promo['code'],
                'discount'        => $discount_val,
                'discount_amount' => $discount_val,
                'type'            => $type,
                'from'            => isset($promo['from']) ? $promo['from'] : null,
                'to'              => isset($promo['to']) ? $promo['to'] : null
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 9. SHIPPING OPTIONS API
    // ------------------------------------------------------------------------
    public function shipping_options() {
        $shipping = $this->db->get('dwalker_shipping')->result_array();

        $this->response(array(
            'status' => 'success',
            'data' => $shipping
        ));
    }

    // ------------------------------------------------------------------------
    // 10. CONTENT PAGES API
    // ------------------------------------------------------------------------
    public function content($id_or_slug = null) {
        if (!$id_or_slug) {
            $this->response(array('status' => 'error', 'message' => 'Page parameter required'), 400);
            return;
        }

        if (is_numeric($id_or_slug)) {
            $content = $this->db->get_where('dwalker_content', array('contentId' => (int)$id_or_slug))->row_array();
        } else {
            $decoded_slug = urldecode($id_or_slug);
            $clean_slug = str_replace('-', ' ', $decoded_slug);

            $this->db->group_start();
            $this->db->where('pageSlug', $decoded_slug);
            $this->db->or_where('pageSlug', $clean_slug);
            $this->db->or_where('pageName', $decoded_slug);
            $this->db->or_where('pageName', $clean_slug);
            $this->db->or_like('pageSlug', $decoded_slug);
            $this->db->or_like('pageName', $clean_slug);
            $this->db->group_end();
            $content = $this->db->get('dwalker_content')->row_array();
        }

        if (!$content) {
            $this->response(array('status' => 'error', 'message' => 'Content page not found'), 404);
            return;
        }

        $this->response(array(
            'status' => 'success',
            'data'   => array(
                'contentId'       => (int)$content['contentId'],
                'pageName'        => trim($content['pageName']),
                'pageDescription' => $content['pageDescription'],
                'pageSlug'        => trim($content['pageSlug'])
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 11. TESTIMONIALS API
    // ------------------------------------------------------------------------
    public function testimonials() {
        $testimonials = $this->db->get('dwalker_testimonial')->result_array();

        foreach ($testimonials as &$t) {
            if (!empty($t['image'])) {
                $t['image_url'] = $this->get_image_url('testimonial', $t['image']);
            }
        }

        $this->response(array(
            'status' => 'success',
            'data' => $testimonials
        ));
    }

    // ------------------------------------------------------------------------
    // HERO BANNERS / CAROUSEL API
    // ------------------------------------------------------------------------
    public function banners() {
        if (!$this->db->table_exists('dwalker_banners')) {
            $this->response(array('status' => 'success', 'data' => array()));
            return;
        }

        $this->db->where('status', 1);
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('banner_id', 'DESC');
        $banners = $this->db->get('dwalker_banners')->result_array();

        foreach ($banners as &$b) {
            $b['media_url'] = rtrim(base_url(), '/') . '/uploads/Banners/' . $b['media_file'];
        }

        $this->response(array(
            'status' => 'success',
            'data' => $banners
        ));
    }

    // ------------------------------------------------------------------------
    // SIGNATURE COLLECTION SECTION API
    // ------------------------------------------------------------------------
    public function signature_collection($key_or_id = null) {
        if (!$this->db->table_exists('dwalker_signature_collection')) {
            $this->response(array('status' => 'error', 'message' => 'Table missing'), 404);
            return;
        }

        if (empty($key_or_id)) {
            $key_or_id = $this->input->get('key');
        }

        if (!empty($key_or_id)) {
            if (is_numeric($key_or_id)) {
                $this->db->where('id', (int)$key_or_id);
            } else {
                $this->db->where('section_key', $key_or_id);
            }
        } else {
            // Default to 'signature_collection' key or first active row
            $this->db->group_start();
            $this->db->where('section_key', 'signature_collection');
            $this->db->or_where('id', 1);
            $this->db->group_end();
        }

        $record = $this->db->get('dwalker_signature_collection')->row_array();

        // If specific key search had no result, fallback to first available section
        if (!$record) {
            $record = $this->db->get('dwalker_signature_collection')->row_array();
        }

        if ($record) {
            $images = array();
            
            // Fetch gallery images for this collection ID
            if ($this->db->table_exists('dwalker_signature_images')) {
                if ($this->db->field_exists('collection_id', 'dwalker_signature_images')) {
                    $this->db->where('collection_id', $record['id']);
                }
                $this->db->order_by('sort_order', 'ASC');
                $this->db->order_by('id', 'ASC');
                $gallery_imgs = $this->db->get('dwalker_signature_images')->result_array();

                foreach ($gallery_imgs as $g) {
                    if (!empty($g['image_file'])) {
                        $images[] = rtrim(base_url(), '/') . '/uploads/Signature/' . $g['image_file'];
                    }
                }
            }

            // Fallback: check legacy image1..image4 columns if gallery is empty
            if (empty($images)) {
                for ($i = 1; $i <= 4; $i++) {
                    $img_key = 'image' . $i;
                    if (!empty($record[$img_key])) {
                        $images[] = rtrim(base_url(), '/') . '/uploads/Signature/' . $record[$img_key];
                    }
                }
            }

            $record['images'] = $images;
        }

        $this->response(array(
            'status' => 'success',
            'data' => $record
        ));
    }

    // Showcase collections list API — returns all active collection sections
    public function showcase_collections() {
        if (!$this->db->table_exists('dwalker_signature_collection')) {
            $this->response(array('status' => 'success', 'data' => array()));
            return;
        }

        $this->db->where('status', 1);
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $records = $this->db->get('dwalker_signature_collection')->result_array();

        foreach ($records as &$rec) {
            $images = array();
            if ($this->db->table_exists('dwalker_signature_images')) {
                if ($this->db->field_exists('collection_id', 'dwalker_signature_images')) {
                    $this->db->where('collection_id', $rec['id']);
                }
                $this->db->order_by('sort_order', 'ASC');
                $this->db->order_by('id', 'ASC');
                $gallery_imgs = $this->db->get('dwalker_signature_images')->result_array();

                foreach ($gallery_imgs as $g) {
                    if (!empty($g['image_file'])) {
                        $images[] = rtrim(base_url(), '/') . '/uploads/Signature/' . $g['image_file'];
                    }
                }
            }
            $rec['images'] = $images;
        }

        $this->response(array(
            'status' => 'success',
            'data' => $records
        ));
    }

    // ------------------------------------------------------------------------
    // 12. COUNTRIES API
    // ------------------------------------------------------------------------
    public function countries() {
        if ($this->db->table_exists('dwalker_country') && !$this->db->field_exists('status', 'dwalker_country')) {
            $this->db->query("ALTER TABLE `dwalker_country` ADD COLUMN `status` TINYINT(1) NOT NULL DEFAULT 1");
        }

        if ($this->db->field_exists('status', 'dwalker_country')) {
            $this->db->where('status', 1);
        }
        $countries = $this->db->get('dwalker_country')->result_array();
        if (empty($countries)) {
            $countries = array(
                array('country_id' => 1, 'country_name' => 'New Zealand', 'country_code' => 'NZ', 'isDefault' => '1', 'status' => 1),
                array('country_id' => 2, 'country_name' => 'Australia', 'country_code' => 'AU', 'isDefault' => '0', 'status' => 1),
                array('country_id' => 3, 'country_name' => 'United States', 'country_code' => 'US', 'isDefault' => '0', 'status' => 1),
                array('country_id' => 4, 'country_name' => 'United Kingdom', 'country_code' => 'UK', 'isDefault' => '0', 'status' => 1),
                array('country_id' => 5, 'country_name' => 'Rest of the world', 'country_code' => 'ROW', 'isDefault' => '0', 'status' => 1)
            );
        }
        $this->response(array(
            'status' => 'success',
            'data' => $countries
        ));
    }

    // ------------------------------------------------------------------------
    // 13. AUTHENTICATION — STEP 1: SEND REGISTRATION EMAIL OTP
    // ------------------------------------------------------------------------
    public function send_register_otp() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $email = isset($post['email']) ? strtolower(trim($post['email'])) : '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->response(array('status' => 'error', 'message' => 'Valid email address is required'), 400);
            return;
        }

        // Check if email already registered in dwalker_users
        $existing = $this->db->get_where('dwalker_users', array('EMAIL_ID' => $email))->row_array();
        if ($existing) {
            $this->response(array('status' => 'error', 'message' => 'Email is already registered. Please login or reset password.'), 400);
            return;
        }

        // Generate 6-digit numeric OTP
        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $cache_key = 'reg_otp_' . md5($email);

        // Save in cache/file session for 10 minutes (600 seconds)
        $this->cache->file->save($cache_key, array('otp' => $otp, 'email' => $email, 'time' => time()), 600);

        // Attempt sending email via PHP mail / CI Email library
        $subject = "Your D Walker Registration OTP Code";
        $message = "Your verification OTP code for D Walker Jewellers registration is: " . $otp . "\n\nThis OTP will expire in 10 minutes.";
        $headers = "From: noreply@dwalker.co.nz\r\nReply-To: noreply@dwalker.co.nz\r\nX-Mailer: PHP/" . phpversion();

        @mail($email, $subject, $message, $headers);

        $this->response(array(
            'status' => 'success',
            'message' => 'OTP has been sent to ' . $email,
            'otp_dev' => $otp // Dev mode helper for immediate testing
        ));
    }

    // ------------------------------------------------------------------------
    // 14. AUTHENTICATION — STEP 2: VERIFY REGISTRATION EMAIL OTP
    // ------------------------------------------------------------------------
    public function verify_register_otp() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $email = isset($post['email']) ? strtolower(trim($post['email'])) : '';
        $otp   = isset($post['otp']) ? trim($post['otp']) : '';

        if (empty($email) || empty($otp)) {
            $this->response(array('status' => 'error', 'message' => 'Email and OTP are required'), 400);
            return;
        }

        $cache_key = 'reg_otp_' . md5($email);
        $cached_data = $this->cache->file->get($cache_key);

        if (!$cached_data || !isset($cached_data['otp'])) {
            $this->response(array('status' => 'error', 'message' => 'OTP expired or not found. Please request a new OTP.'), 400);
            return;
        }

        if ($cached_data['otp'] !== $otp) {
            $this->response(array('status' => 'error', 'message' => 'Invalid OTP code. Please check and try again.'), 400);
            return;
        }

        // Generate verified token valid for 15 mins (900s)
        $verified_token = bin2hex(random_bytes(16));
        $token_key = 'verified_email_' . $verified_token;
        $this->cache->file->save($token_key, $email, 900);

        // Clear used OTP
        $this->cache->file->delete($cache_key);

        $this->response(array(
            'status' => 'success',
            'message' => 'Email verified successfully!',
            'verified_email_token' => $verified_token
        ));
    }

    // ------------------------------------------------------------------------
    // 15. AUTHENTICATION — STEP 3: COMPLETE REGISTRATION (WITH BCRYPT & EMAIL VERIFICATION)
    // ------------------------------------------------------------------------
    public function register() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;

        // Bot protection: Honeypot check & rate limiting
        $bot_check = $this->is_bot_submission($post, 'reg_rate', 10, 600);
        if ($bot_check === true) {
            // Fake success response to deflect bot
            $this->response(array(
                'status'  => 'success',
                'message' => 'Registration successful! Please check your email to verify your account.',
                'data'    => array(
                    'user_id'     => rand(1000, 9999),
                    'fullname'    => isset($post['fullname']) ? trim($post['fullname']) : '',
                    'email'       => isset($post['email']) ? trim($post['email']) : '',
                    'is_verified' => 0
                )
            ));
            return;
        } elseif ($bot_check === 'rate_limited') {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Too many registration attempts. Please wait a few minutes before trying again.'
            ), 429);
            return;
        }

        $token     = isset($post['verified_email_token']) ? trim($post['verified_email_token']) : '';
        $email     = isset($post['email']) ? strtolower(trim($post['email'])) : '';
        $fullname  = isset($post['fullname']) ? trim($post['fullname']) : '';
        $mobile_no = isset($post['mobile_no']) ? trim($post['mobile_no']) : '';
        $country   = isset($post['country']) ? trim($post['country']) : 'New Zealand';
        $address   = isset($post['address']) ? trim($post['address']) : '';
        $password  = isset($post['password']) ? trim($post['password']) : '';

        if (empty($email) || empty($password) || empty($fullname)) {
            $this->response(array('status' => 'error', 'message' => 'Full name, email, and password are required.'), 400);
            return;
        }


        if (strlen($password) < 6) {
            $this->response(array('status' => 'error', 'message' => 'Password must be at least 6 characters long.'), 400);
            return;
        }

        // Double check existing email
        $existing = $this->db->get_where('dwalker_users', array('EMAIL_ID' => $email))->row_array();
        if ($existing) {
            $this->response(array('status' => 'error', 'message' => 'Email is already registered.'), 400);
            return;
        }

        // Hash password securely with Bcrypt (cost 12)
        $bcrypt_password = hash_password_secure($password);

        // Generate email verification token (valid for 24 hours)
        $verify_token = bin2hex(random_bytes(32));
        $token_expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $user_data = array(
            'FULLNAME'           => $fullname,
            'EMAIL_ID'           => $email,
            'PASSWORD'           => $bcrypt_password,
            'MOBILE_NO'          => $mobile_no,
            'COUNTRY'            => $country,
            'SADDRESS'           => $address,
            'REG_DATE'           => date('Y-m-d'),
            'USER_PROF_ID'       => '',
            'PASSOTP'            => '',
            'PASSOTPTIME'        => '0000-00-00 00:00:00',
            'is_verified'        => 0,
            'verification_token' => $verify_token,
            'token_expiry'       => $token_expiry
        );

        $this->db->insert('dwalker_users', $user_data);
        $user_id = $this->db->insert_id();

        // Send verification email using centralized email config
        $this->send_verification_link_email($email, $fullname, $verify_token);

        $this->response(array(
            'status'  => 'success',
            'message' => 'Registration successful! We have sent a verification email to ' . $email . '. Please check your inbox and verify your email to log in.',
            'data'    => array(
                'id'          => $user_id,
                'fullname'    => $fullname,
                'email'       => $email,
                'is_verified' => 0
            )
        ));
    }

    // Private helper to send verification email using centralized application/config/email.php
    private function send_verification_link_email($email, $fullname, $token) {
        $this->load->library('email');
        $this->load->config('email', TRUE);

        // Determine Next.js front-end URL
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : (isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_SCHEME) . '://' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) . (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PORT) ? ':' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PORT) : '') : 'http://localhost:3000');
        if (empty($origin) || $origin === '://') {
            $origin = 'http://localhost:3000';
        }

        $verify_url = rtrim($origin, '/') . '/verify-email?token=' . urlencode($token);

        $subject = "Verify Your Email - D. Walker Jewellers";
        $body = '<div style="font-family: \'Plus Jakarta Sans\', Arial, sans-serif; background-color: #faf9f6; padding: 40px 20px; color: #1c1917;">
            <table align="center" width="600" style="background-color: #ffffff; border: 1px solid #e7e5e4; border-top: 4px solid #b79a62; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center;">
                <tr>
                    <td align="center">
                        <h2 style="font-family: Georgia, serif; font-size: 24px; color: #1a365d; margin-bottom: 8px;">D. WALKER JEWELLERS</h2>
                        <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #b79a62; margin-bottom: 30px;">Fine Handcrafted Jewellery</p>
                        <h3 style="font-size: 20px; color: #1c1917; margin-bottom: 16px;">Welcome, ' . htmlspecialchars($fullname) . '</h3>
                        <p style="font-size: 14px; color: #57534e; line-height: 1.6; margin-bottom: 30px;">
                            Thank you for creating an account with D. Walker Jewellers. Please verify your email address to activate your account and start shopping.
                        </p>
                        <div style="margin-bottom: 35px;">
                            <a href="' . $verify_url . '" style="display: inline-block; background-color: #1a365d; color: #ffffff; padding: 14px 32px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1.5px; text-decoration: none; border-radius: 2px;">
                                Verify Email Address
                            </a>
                        </div>
                        <p style="font-size: 12px; color: #a8a29e; line-height: 1.5;">
                            Or copy and paste this verification link into your browser:<br>
                            <a href="' . $verify_url . '" style="color: #b79a62; word-break: break-all;">' . $verify_url . '</a>
                        </p>
                        <p style="font-size: 11px; color: #a8a29e; margin-top: 25px;">
                            This link expires in 24 hours. If you did not create this account, please disregard this email.
                        </p>
                    </td>
                </tr>
            </table>
        </div>';

        $this->email->clear();
        $this->email->from($this->config->item('from_email') ?: 'techsofttest123@gmail.com', $this->config->item('from_name') ?: 'D. Walker Jewellers');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($body);
        return @$this->email->send();
    }

    // ------------------------------------------------------------------------
    // 15b. VERIFY EMAIL LINK API
    // ------------------------------------------------------------------------
    public function verify_email() {
        $token = $this->input->get('token') ?: $this->input->post('token');
        if (empty($token)) {
            $post = json_decode(file_get_contents('php://input'), true);
            if (!empty($post['token'])) {
                $token = trim($post['token']);
            }
        }

        if (empty($token)) {
            $this->response(array('status' => 'error', 'message' => 'Verification token is required.'), 400);
            return;
        }

        $user = $this->db->get_where('dwalker_users', array('verification_token' => $token))->row_array();
        if (!$user) {
            $this->response(array('status' => 'error', 'message' => 'Invalid or expired verification link.'), 400);
            return;
        }

        if (!empty($user['is_verified']) && (int)$user['is_verified'] === 1) {
            $this->response(array(
                'status'  => 'success',
                'message' => 'Email is already verified. You can sign in now.',
                'data'    => array('email' => $user['EMAIL_ID'], 'fullname' => $user['FULLNAME'])
            ));
            return;
        }

        // Check expiry
        if (!empty($user['token_expiry']) && strtotime($user['token_expiry']) < time()) {
            $this->response(array('status' => 'error', 'message' => 'Verification link has expired. Please request a new one.'), 400);
            return;
        }

        // Mark as verified and clear token
        $this->db->where('USER_ID', $user['USER_ID']);
        $this->db->update('dwalker_users', array(
            'is_verified'        => 1,
            'verification_token' => NULL,
            'token_expiry'       => NULL
        ));

        $this->response(array(
            'status'  => 'success',
            'message' => 'Email verified successfully! You can now log in.',
            'data'    => array(
                'email'    => $user['EMAIL_ID'],
                'fullname' => $user['FULLNAME']
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 15c. RESEND VERIFICATION EMAIL API
    // ------------------------------------------------------------------------
    public function resend_verification_email() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $email = isset($post['email']) ? strtolower(trim($post['email'])) : '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->response(array('status' => 'error', 'message' => 'Valid email address is required.'), 400);
            return;
        }

        $user = $this->db->get_where('dwalker_users', array('EMAIL_ID' => $email))->row_array();
        if (!$user) {
            $this->response(array('status' => 'error', 'message' => 'No account found with this email.'), 404);
            return;
        }

        if (!empty($user['is_verified']) && (int)$user['is_verified'] === 1) {
            $this->response(array('status' => 'error', 'message' => 'This account is already verified. Please sign in.'), 400);
            return;
        }

        $new_token = bin2hex(random_bytes(32));
        $new_expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $this->db->where('USER_ID', $user['USER_ID']);
        $this->db->update('dwalker_users', array(
            'verification_token' => $new_token,
            'token_expiry'       => $new_expiry
        ));

        $this->send_verification_link_email($email, $user['FULLNAME'], $new_token);

        $this->response(array(
            'status'  => 'success',
            'message' => 'A new verification link has been sent to ' . $email . '.'
        ));
    }

    // ------------------------------------------------------------------------
    // 16. AUTHENTICATION — USER LOGIN (BCRYPT & EMAIL VERIFICATION ENFORCED)
    // ------------------------------------------------------------------------
    public function login() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $email    = isset($post['email']) ? strtolower(trim($post['email'])) : '';
        $password = isset($post['password']) ? trim($post['password']) : '';

        if (empty($email) || empty($password)) {
            $this->response(array('status' => 'error', 'message' => 'Email and password are required'), 400);
            return;
        }

        $user = $this->db->get_where('dwalker_users', array('EMAIL_ID' => $email))->row_array();

        if (!$user) {
            $this->response(array('status' => 'error', 'message' => 'Invalid email or password'), 401);
            return;
        }

        // Verify password using auth_security_helper (supports Bcrypt & auto-upgrades legacy MD5/SHA1)
        $is_valid = verify_and_upgrade_password(
            $password,
            $user['PASSWORD'],
            'dwalker_users',
            'USER_ID',
            $user['USER_ID'],
            'PASSWORD'
        );

        if (!$is_valid) {
            $this->response(array('status' => 'error', 'message' => 'Invalid email or password'), 401);
            return;
        }

        // RESTRICT LOGIN IF EMAIL IS NOT VERIFIED
        if (isset($user['is_verified']) && (int)$user['is_verified'] === 0) {
            $this->response(array(
                'status'         => 'error',
                'error_code'     => 'EMAIL_NOT_VERIFIED',
                'message'        => 'Please verify your email address before signing in. Check your inbox for the verification link.',
                'email'          => $user['EMAIL_ID']
            ), 403);
            return;
        }

        $user_profile = array(
            'id'        => $user['USER_ID'],
            'fullname'  => $user['FULLNAME'],
            'email'     => $user['EMAIL_ID'],
            'mobile_no' => $user['MOBILE_NO'],
            'country'   => $user['COUNTRY'],
            'address'   => $user['SADDRESS']
        );

        $this->response(array(
            'status'  => 'success',
            'message' => 'Login successful',
            'data'    => $user_profile
        ));
    }

    // ------------------------------------------------------------------------
    // 17. FORGOT PASSWORD — SEND OTP
    // ------------------------------------------------------------------------
    public function forgot_password() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $email = isset($post['email']) ? strtolower(trim($post['email'])) : '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->response(array('status' => 'error', 'message' => 'Valid email address is required'), 400);
            return;
        }

        $user = $this->db->get_where('dwalker_users', array('EMAIL_ID' => $email))->row_array();

        if (!$user) {
            $this->response(array('status' => 'error', 'message' => 'No account found with this email address'), 404);
            return;
        }

        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $now = date('Y-m-d H:i:s');

        $this->db->where('USER_ID', $user['USER_ID']);
        $this->db->update('dwalker_users', array(
            'PASSOTP' => $otp,
            'PASSOTPTIME' => $now
        ));

        // Send Email
        $subject = "D Walker Password Reset Code";
        $message = "Your password reset OTP code is: " . $otp . "\n\nThis OTP will expire in 15 minutes.";
        $headers = "From: noreply@dwalker.co.nz\r\nReply-To: noreply@dwalker.co.nz\r\nX-Mailer: PHP/" . phpversion();

        @mail($email, $subject, $message, $headers);

        $this->response(array(
            'status' => 'success',
            'message' => 'Password reset OTP sent to ' . $email,
            'otp_dev' => $otp // Dev mode helper
        ));
    }

    // ------------------------------------------------------------------------
    // 18. RESET PASSWORD WITH OTP (BCRYPT)
    // ------------------------------------------------------------------------
    public function reset_password() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $email        = isset($post['email']) ? strtolower(trim($post['email'])) : '';
        $otp          = isset($post['otp']) ? trim($post['otp']) : '';
        $new_password = isset($post['new_password']) ? trim($post['new_password']) : '';

        if (empty($email) || empty($otp) || empty($new_password)) {
            $this->response(array('status' => 'error', 'message' => 'All fields are required'), 400);
            return;
        }

        if (strlen($new_password) < 6) {
            $this->response(array('status' => 'error', 'message' => 'Password must be at least 6 characters long'), 400);
            return;
        }

        $user = $this->db->get_where('dwalker_users', array('EMAIL_ID' => $email))->row_array();

        if (!$user || $user['PASSOTP'] !== $otp) {
            $this->response(array('status' => 'error', 'message' => 'Invalid OTP code'), 400);
            return;
        }

        // Check 15 min expiration
        $otp_time = strtotime($user['PASSOTPTIME']);
        if ((time() - $otp_time) > 900) {
            $this->response(array('status' => 'error', 'message' => 'OTP has expired. Please request a new one.'), 400);
            return;
        }

        // Hash new password using modern Bcrypt
        $bcrypt_password = hash_password_secure($new_password);

        $this->db->where('USER_ID', $user['USER_ID']);
        $this->db->update('dwalker_users', array(
            'PASSWORD' => $bcrypt_password,
            'PASSOTP' => '',
            'PASSOTPTIME' => '0000-00-00 00:00:00'
        ));

        $this->response(array(
            'status' => 'success',
            'message' => 'Password reset successfully! You can now log in with your new password.'
        ));
    }

    // ------------------------------------------------------------------------
    // 19. CHECKOUT / PLACE ORDER API
    // ------------------------------------------------------------------------
    public function place_order() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;

        // Bot protection: Honeypot check & rate limiting
        $bot_check = $this->is_bot_submission($post, 'order_rate', 15, 600);
        if ($bot_check === true) {
            // Fake success response to deflect bot without placing order
            $fake_order_id = 'DW' . rand(100000, 999999);
            $this->response(array(
                'status'  => 'success',
                'message' => 'Order placed successfully!',
                'data'    => array(
                    'order_id'       => $fake_order_id,
                    'transaction_id' => 'TR' . rand(10000, 99999),
                    'total'          => 0,
                )
            ));
            return;
        } elseif ($bot_check === 'rate_limited') {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Too many requests. Please wait a few moments before trying again.'
            ), 429);
            return;
        }

        $items = isset($post['items']) ? $post['items'] : array();
        $name = isset($post['name']) ? trim($post['name']) : '';
        $email = isset($post['email']) ? trim($post['email']) : '';
        $phone = isset($post['phone']) ? trim($post['phone']) : '';
        $address = isset($post['address']) ? trim($post['address']) : '';
        $street = isset($post['street']) ? trim($post['street']) : '';
        $suburb = isset($post['suburb']) ? trim($post['suburb']) : '';
        $city = isset($post['city']) ? trim($post['city']) : '';
        $postcode = isset($post['postcode']) ? trim($post['postcode']) : (isset($post['postCode']) ? trim($post['postCode']) : '');
        $address_id = isset($post['address_id']) ? (int)$post['address_id'] : 0;
        $country = isset($post['country']) ? trim($post['country']) : 'New Zealand';

        // Fallback: parse discrete fields from address if not sent separately
        if (empty($street) && !empty($address)) {
            $parts = array_map('trim', explode(',', $address));
            if (count($parts) >= 4) {
                $street = $parts[0];
                $suburb = $parts[1];
                $city = $parts[2];
                $postcode = preg_replace('/[^0-9]/', '', $parts[3]);
            } elseif (count($parts) === 3) {
                $street = $parts[0];
                $suburb = $parts[1];
                $city = $parts[2];
            } elseif (count($parts) === 2) {
                $street = $parts[0];
                $city = $parts[1];
            } else {
                $street = $address;
            }
        }
        $instruction = isset($post['instruction']) ? trim($post['instruction']) : '';
        $subtotal = isset($post['subtotal']) ? (float)$post['subtotal'] : 0;
        $shipping = isset($post['shipping']) ? (float)$post['shipping'] : 0;
        $discount = isset($post['discount']) ? (float)$post['discount'] : 0;
        $total = isset($post['total']) ? (float)$post['total'] : ($subtotal + $shipping - $discount);
        $payment_method = isset($post['payment_method']) ? trim($post['payment_method']) : 'card';

        if (empty($items) || !is_array($items)) {
            $this->response(array('status' => 'error', 'message' => 'Cart items are required to place an order'), 400);
            return;
        }


        // Verify no upcoming products are in the cart
        $item_ids = array();
        foreach ($items as $item) {
            $pid = isset($item['id']) ? $item['id'] : (isset($item['product_id']) ? $item['product_id'] : null);
            if (!empty($pid)) {
                $item_ids[] = $pid;
            }
        }
        if (!empty($item_ids)) {
            $this->db->select('product_id, product_name, upcoming');
            $this->db->from('dwalker_product');
            $this->db->where_in('product_id', $item_ids);
            $this->db->where('upcoming', 1);
            $upcoming_found = $this->db->get()->result_array();
            if (!empty($upcoming_found)) {
                $prod_names = implode(', ', array_column($upcoming_found, 'product_name'));
                $this->response(array(
                    'status' => 'error',
                    'message' => "Upcoming products cannot be ordered: " . $prod_names
                ), 400);
                return;
            }
        }

        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $this->response(array('status' => 'error', 'message' => 'Contact and shipping information are required'), 400);
            return;
        }

        // Generate Transaction ID / Order ID
        $last_trans = $this->db->select_max('payID')->get('dwalker_payments')->row_array();
        $next_id = ($last_trans && !empty($last_trans['payID'])) ? ((int)$last_trans['payID'] + 1) : rand(10000, 99999);
        $trans_id = 'TR' . $next_id . date('s');
        $order_id = 'DW' . rand(100000, 999999);

        $promocode = isset($post['promocode']) ? trim($post['promocode']) : '';
        $promo_dis = $discount;

        // If promocode used, record in dwalker_usedpromo
        if (!empty($promocode) && !empty($email)) {
            if ($this->db->table_exists('dwalker_usedpromo')) {
                $this->db->insert('dwalker_usedpromo', array(
                    'promocode' => $promocode,
                    'email'     => strtolower($email)
                ));
            }
        }

        // Total Tax calculation across cart items
        $tax = isset($post['tax']) ? (float)$post['tax'] : 0;
        if ($tax <= 0) {
            foreach ($items as $it) {
                $it_tax = isset($it['tax']) ? (float)$it['tax'] : 0;
                $it_qty = isset($it['quantity']) ? (int)$it['quantity'] : (isset($it['qty']) ? (int)$it['qty'] : 1);
                $tax += ($it_tax * $it_qty);
            }
        }

        // Summary item text for master payment row (e.g. "Product A, Product B")
        $item_names = array();
        $total_qty = 0;
        foreach ($items as $it) {
            $it_name = isset($it['name']) ? $it['name'] : (isset($it['product_name']) ? $it['product_name'] : 'Product');
            $it_qty = isset($it['quantity']) ? (int)$it['quantity'] : (isset($it['qty']) ? (int)$it['qty'] : 1);
            $item_names[] = $it_name;
            $total_qty += $it_qty;
        }
        $master_product_summary = implode(', ', array_slice($item_names, 0, 3));
        if (count($item_names) > 3) {
            $master_product_summary .= ' +' . (count($item_names) - 3) . ' more';
        }

        // Identify registered user if logged in or by email match
        $user_id = isset($post['user_id']) ? (int)$post['user_id'] : 0;
        if (empty($user_id) && !empty($email)) {
            $user_match = $this->db->get_where('dwalker_users', array('EMAIL_ID' => $email))->row_array();
            if ($user_match && !empty($user_match['USER_ID'])) {
                $user_id = (int)$user_match['USER_ID'];
            }
        }

        // 1. Insert Master Order record into dwalker_payments (Exactly 1 row per order)
        $master_data = array(
            'USER_ID'         => !empty($user_id) ? $user_id : null,
            'TransId'         => $trans_id,
            'OrderID'         => $order_id,
            'payProduct'      => $master_product_summary,
            'payQuantity'     => $total_qty,
            'payPrice'        => $subtotal,
            'payName'         => $name,
            'payCountry'      => $country,
            'payPhone'        => $phone,
            'payEmail'        => $email,
            'payAddress'      => $address,
            'payAddressId'    => $address_id,
            'payStreet'       => $street,
            'paySuburb'       => $suburb,
            'payCity'         => $city,
            'payPostCode'     => $postcode,
            'payInstruction'  => $instruction,
            'payShipping'     => $shipping,
            'payTax'          => $tax,
            'promo_status'    => !empty($promocode) ? 1 : 0,
            'promo_dis'       => $promo_dis,
            'payTotalsingle'  => $subtotal,
            'payTotalbefore'  => $subtotal,
            'payTotal'        => $total,
            'payDate'         => date('Y-m-d'),
            'payTime'         => date('H:i:s')
        );

        $this->db->insert('dwalker_payments', $master_data);
        $master_pay_id = $this->db->insert_id();

        // 2. Insert Individual Cart Items into dwalker_order_products linked to master payID
        foreach ($items as $item) {
            $prod_id = isset($item['id']) ? $item['id'] : (isset($item['product_id']) ? $item['product_id'] : '0');
            $prod_name = isset($item['name']) ? $item['name'] : (isset($item['product_name']) ? $item['product_name'] : 'Product');
            $prod_qty = isset($item['quantity']) ? (int)$item['quantity'] : (isset($item['qty']) ? (int)$item['qty'] : 1);
            $prod_price = isset($item['price']) ? (float)$item['price'] : 0;
            $prod_tax = isset($item['tax']) ? (float)$item['tax'] : 0;

            $item_data = array(
                'OrderID'     => $master_pay_id,
                'payProduct'  => $prod_name,
                'payProID'    => $prod_id,
                'payQuantity' => $prod_qty,
                'payPrice'    => $prod_price,
                'payTax'      => $prod_tax
            );

            $this->db->insert('dwalker_order_products', $item_data);
        }

        $this->response(array(
            'status'  => 'success',
            'message' => 'Order placed successfully!',
            'data'    => array(
                'order_id'       => $order_id,
                'transaction_id' => $trans_id,
                'total'          => $total,
                'subtotal'       => $subtotal,
                'shipping'       => $shipping,
                'discount'       => $discount
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 20. SHIPPING CALCULATION API (Based on CodeIgniter dwalker_shipping logic)
    // ------------------------------------------------------------------------
    public function calculate_shipping() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $country_id = isset($post['country_id']) ? $post['country_id'] : $this->input->get('country_id');
        $subtotal   = isset($post['subtotal']) ? (float)$post['subtotal'] : (float)$this->input->get('subtotal');

        if (empty($country_id)) {
            // Default free shipping or default NZ
            $this->response(array(
                'status' => 'success',
                'data' => array(
                    'shipping_fee'   => 0,
                    'is_free'        => ($subtotal >= 130),
                    'free_threshold' => 130,
                    'currency'       => 'NZD'
                )
            ));
            return;
        }

        // Query by country_id or country_name
        if (is_numeric($country_id)) {
            $country_row = $this->db->get_where('dwalker_country', array('country_id' => $country_id))->row_array();
            $country_name = $country_row ? $country_row['country_name'] : '';
            $currency = ($country_row && !empty($country_row['Currency'])) ? $country_row['Currency'] : 'NZD';
        } else {
            $country_name = $country_id;
            $country_row = $this->db->get_where('dwalker_country', array('country_name' => $country_name))->row_array();
            $currency = ($country_row && !empty($country_row['Currency'])) ? $country_row['Currency'] : 'NZD';
        }

        $shipping_det = $this->db->get_where('dwalker_shipping', array('country_name' => $country_name))->row_array();
        if (!$shipping_det && is_numeric($country_id)) {
            $shipping_det = $this->db->get_where('dwalker_shipping', array('shipping_id' => $country_id))->row_array();
        }

        $shipping_fee = 0;
        $max_price = 130;
        $ship_less = 0;

        if ($shipping_det) {
            $base_price = (float)$shipping_det['shipPrice'];
            $max_price  = (float)$shipping_det['shipPriceGreater']; // e.g. 130 (free shipping threshold)
            $ship_less  = (float)$shipping_det['shipPriceLess'];    // e.g. 0

            if ($subtotal >= $max_price) {
                $shipping_fee = $ship_less;
            } else {
                $shipping_fee = $base_price;
            }
        } else {
            // Default rule: free above 130 NZD, otherwise 10 NZD standard courier
            $shipping_fee = ($subtotal >= 130) ? 0 : 10;
        }

        $this->response(array(
            'status' => 'success',
            'data' => array(
                'country_name'   => $country_name,
                'shipping_fee'   => $shipping_fee,
                'is_free'        => ($shipping_fee == 0),
                'free_threshold' => $max_price,
                'currency'       => $currency,
                'total_amount'   => $subtotal + $shipping_fee
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 21. NZPOST ADDRESS AUTOCOMPLETE API
    // ------------------------------------------------------------------------
    public function nzpost_search_address() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $term = isset($post['term']) ? trim($post['term']) : $this->input->get('term');
        $country_code = isset($post['country_code']) ? trim($post['country_code']) : ($this->input->get('country_code') ?: 'NZ');

        if (empty($term) || strlen($term) < 3) {
            $this->response(array('status' => 'success', 'addresses' => array()));
            return;
        }

        $this->load->config('nzpost_config');
        $client_id = $this->config->item('client_id');
        $client_secret = $this->config->item('client_secret');
        $auth_url = $this->config->item('nz_auth_url');
        $search_url = $this->config->item('nz_search_address_url');

        // Check or fetch OAuth token
        $token = $this->cache->file->get('nzpost_access_token');
        if (!$token && $client_id && $client_secret) {
            $ch = curl_init($auth_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'grant_type'    => 'client_credentials',
                'client_id'     => $client_id,
                'client_secret' => $client_secret
            )));
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            $auth_res = curl_exec($ch);
            curl_close($ch);

            $auth_json = json_decode($auth_res, true);
            if (!empty($auth_json['access_token'])) {
                $token = $auth_json['access_token'];
                $expires = isset($auth_json['expires_in']) ? (int)$auth_json['expires_in'] : 3500;
                $this->cache->file->save('nzpost_access_token', $token, $expires);
            }
        }

        if (!$token) {
            $this->response(array('status' => 'success', 'addresses' => array()));
            return;
        }

        $q = urlencode(strtolower($term));
        $full_url = "{$search_url}?count=10&q={$q}&country_code={$country_code}";

        $ch = curl_init($full_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'client_id: ' . $client_id,
            'Authorization: Bearer ' . $token
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        $result_data = json_decode($result, true) ?: array('addresses' => array());
        $this->response(array('status' => 'success', 'data' => $result_data));
    }

    // ------------------------------------------------------------------------
    // 22. NZPOST GET ADDRESS DETAILS API
    // ------------------------------------------------------------------------
    public function nzpost_address_details() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $address_id = isset($post['address_id']) ? trim($post['address_id']) : $this->input->get('address_id');

        if (empty($address_id)) {
            $this->response(array('status' => 'error', 'message' => 'address_id is required'), 400);
            return;
        }

        $this->load->config('nzpost_config');
        $client_id = $this->config->item('client_id');
        $detail_url = $this->config->item('nz_address_detail_url') . $address_id;
        $token = $this->cache->file->get('nzpost_access_token');

        if (!$token) {
            $this->response(array('status' => 'error', 'message' => 'Token expired'), 401);
            return;
        }

        $ch = curl_init($detail_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'client_id: ' . $client_id,
            'Authorization: Bearer ' . $token
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        $result_data = json_decode($result, true) ?: array();
        $this->response(array('status' => 'success', 'data' => $result_data));
    }

    // ------------------------------------------------------------------------
    // 23. WINDCAVE PAYMENT SESSION API (For Next.js Checkout)
    // ------------------------------------------------------------------------
    public function windcave_create_session() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $order_id = isset($post['order_id']) ? trim($post['order_id']) : '';
        $trans_id = isset($post['transaction_id']) ? trim($post['transaction_id']) : '';

        if (empty($order_id)) {
            $this->response(array('status' => 'error', 'message' => 'Order ID is required'), 400);
            return;
        }

        // Fetch payment row from dwalker_payments
        $order_row = $this->db->get_where('dwalker_payments', array('OrderID' => $order_id))->row_array();
        if (!$order_row && !empty($trans_id)) {
            $order_row = $this->db->get_where('dwalker_payments', array('TransId' => $trans_id))->row_array();
        }

        if (!$order_row) {
            $this->response(array('status' => 'error', 'message' => 'Order not found'), 404);
            return;
        }

        $pay_amount = floatval($order_row['payTotal']);
        $pay_amount = number_format($pay_amount, 2, '.', '');

        $config = get_windcave_config();
        $url = rtrim($config['api_url'], '/') . '/sessions';

        // Return user to Next.js dwalker_next confirming-payment page
        // Detect origin (default to http://localhost:3000 if request comes from Next.js)
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : (isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_SCHEME) . '://' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) . (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PORT) ? ':' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PORT) : '') : 'http://localhost:3000');
        if (empty($origin) || $origin === '://') {
            $origin = 'http://localhost:3000';
        }

        $next_confirming_url = rtrim($origin, '/') . '/confirming-payment';
        $fprn_notification_url = base_url() . 'Payment/Notification';

        $payload = array(
            'type'              => 'purchase',
            'amount'            => $pay_amount,
            'currency'          => 'NZD',
            'merchantReference' => $order_id,
            'callbackUrls'      => array(
                'approved'  => $next_confirming_url,
                'declined'  => $next_confirming_url,
                'cancelled' => $next_confirming_url
            ),
            'notificationUrl'   => $fprn_notification_url
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $config['auth_header']
        ));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $json_response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($json_response, true);

        if (!empty($response['id'])) {
            $session_id = $response['id'];
            $hpp_url = '';

            if (!empty($response['links'])) {
                foreach ($response['links'] as $link) {
                    if (isset($link['rel']) && $link['rel'] === 'hpp') {
                        $hpp_url = $link['href'];
                    }
                }
            }

            // Save sessionId and formatted order ID to all payment rows for this OrderID
            $length_code = 6;
            $code_seed = !empty($order_row['TransId']) ? $order_row['TransId'] : $order_row['payID'];
            $string_code = substr(str_repeat('0', $length_code) . $code_seed, - $length_code);
            $orderID_FINAL = "DWJ-ORDER#" . $string_code;

            $this->db->where('OrderID', $order_id);
            $this->db->update('dwalker_payments', array(
                'paySessionId' => $session_id,
                'payOrderid'   => $orderID_FINAL
            ));

            $this->response(array(
                'status'  => 'success',
                'message' => 'Windcave session created successfully',
                'data'    => array(
                    'session_id'     => $session_id,
                    'payment_url'    => $hpp_url,
                    'order_id'       => $order_id,
                    'order_id_final' => $orderID_FINAL
                )
            ));
        } else {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Could not initiate Windcave session',
                'details' => $response
            ), 500);
        }
    }

    // ------------------------------------------------------------------------
    // 24. PAYMENT STATUS CHECK API (Polled by Next.js Confirming Payment Page)
    // ------------------------------------------------------------------------
    public function payment_status() {
        $session_id = $this->input->get('sessionId');
        if (empty($session_id)) {
            $session_id = $this->input->get('id');
        }

        if (empty($session_id)) {
            $this->response(array('status' => 'error', 'message' => 'sessionId parameter is required'), 400);
            return;
        }

        // Check local database first
        $order = $this->db->get_where('dwalker_payments', array('paySessionId' => $session_id))->row_array();

        if ($order && (int)$order['payStatus'] === 1) {
            $this->response(array(
                'status'   => 'success',
                'data'     => array(
                    'payment_status' => 'approved',
                    'order_id'       => $order['OrderID'],
                    'order_id_final' => $order['payOrderID'],
                    'total'          => $order['payTotal'],
                    'customer_name'  => $order['payName'],
                    'customer_email' => $order['payEmail'],
                    'customer_phone' => $order['payPhone'],
                    'street'         => $order['payStreet'],
                    'suburb'         => $order['paySuburb'],
                    'city'           => $order['payCity'],
                    'postcode'       => $order['payPostCode']
                )
            ));
            return;
        }

        if ($order && (int)$order['payStatus'] === 2) {
            $this->response(array(
                'status'   => 'success',
                'data'     => array(
                    'payment_status' => 'declined',
                    'order_id'       => $order['OrderID']
                )
            ));
            return;
        }

        // If not finalized yet, query Windcave session directly to verify/finalize
        $session_data = windcave_query_session($session_id);
        if (!empty($session_data)) {
            $final_res = windcave_finalize_order($session_id, $session_data);
            $updated_order = $this->db->get_where('dwalker_payments', array('paySessionId' => $session_id))->row_array();

            $status_str = isset($final_res['status']) ? $final_res['status'] : 'pending';

            $this->response(array(
                'status' => 'success',
                'data'   => array(
                    'payment_status' => $status_str,
                    'order_id'       => $updated_order ? $updated_order['OrderID'] : '',
                    'order_id_final' => $updated_order ? $updated_order['payOrderID'] : '',
                    'total'          => $updated_order ? $updated_order['payTotal'] : 0,
                    'customer_name'  => $updated_order ? $updated_order['payName'] : '',
                    'customer_email' => $updated_order ? $updated_order['payEmail'] : '',
                    'customer_phone' => $updated_order ? $updated_order['payPhone'] : '',
                    'street'         => $updated_order ? $updated_order['payStreet'] : '',
                    'suburb'         => $updated_order ? $updated_order['paySuburb'] : '',
                    'city'           => $updated_order ? $updated_order['payCity'] : '',
                    'postcode'       => $updated_order ? $updated_order['payPostCode'] : ''
                )
            ));
            return;
        }

        $this->response(array(
            'status' => 'success',
            'data'   => array(
                'payment_status' => 'pending',
                'order_id'       => $order ? $order['OrderID'] : ''
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 25. ORDER TRACKING API (LIVE NZ POST API & ORDER DATABASE WITH RATE LIMITING)
    // ------------------------------------------------------------------------
    public function track_order() {
        $ip = $this->input->ip_address();
        $rate_key = 'track_rate_' . md5($ip);
        $attempts = (int)$this->cache->file->get($rate_key);

        // Rate limit: max 25 tracking queries per 10 minutes per IP
        if ($attempts >= 25) {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Too many tracking requests. Please wait a few minutes before trying again.'
            ), 429);
            return;
        }
        $this->cache->file->save($rate_key, $attempts + 1, 600);

        $order_id = trim($this->input->get('order_id') ?: $this->input->post('order_id'));

        if (empty($order_id)) {
            $this->response(array('status' => 'error', 'message' => 'Order ID is required.'), 400);
            return;
        }

        // Search in payments table by OrderID, payOrderID, or payID
        $order = $this->db->group_start()
                          ->where('OrderID', $order_id)
                          ->or_where('payOrderID', $order_id)
                          ->or_where('payID', $order_id)
                          ->group_end()
                          ->get('dwalker_payments')
                          ->row_array();

        if (!$order) {
            $this->response(array(
                'status'  => 'error',
                'message' => 'No order found matching the provided Order ID (' . htmlspecialchars($order_id) . '). Please verify and try again.'
            ), 404);
            return;
        }

        $order_items = $this->db->get_where('dwalker_order_products', array('OrderID' => $order['payID']))->result_array();

        $tracking_events = array();

        // If tracking reference exists, query NZ Post API live
        if (!empty($order['orderTrackingRef'])) {
            $this->load->config('nzpost_config');
            $client_id = $this->config->item('client_id');
            $client_secret = $this->config->item('client_secret');
            $auth_url = $this->config->item('nz_auth_url');

            $token = $this->cache->file->get('nzpost_access_token');
            if (!$token && $client_id && $client_secret) {
                $ch = curl_init($auth_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                    'grant_type'    => 'client_credentials',
                    'client_id'     => $client_id,
                    'client_secret' => $client_secret
                )));
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
                $auth_res = curl_exec($ch);
                curl_close($ch);

                $auth_json = json_decode($auth_res, true);
                if (!empty($auth_json['access_token'])) {
                    $token = $auth_json['access_token'];
                    $expires = isset($auth_json['expires_in']) ? (int)$auth_json['expires_in'] : 3500;
                    $this->cache->file->save('nzpost_access_token', $token, $expires);
                }
            }

            if ($token) {
                $track_url = 'https://api.nzpost.co.nz/parceltrack/3.0/parcels/' . urlencode($order['orderTrackingRef']);
                $ch = curl_init($track_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'client_id: ' . $client_id,
                    'Authorization: Bearer ' . $token
                ));
                $track_res = curl_exec($ch);
                curl_close($ch);

                $track_json = json_decode($track_res, true);
                if (!empty($track_json['results']) && !empty($track_json['results']['tracking_events'])) {
                    $tracking_events = $track_json['results']['tracking_events'];
                }
            }
        }

        // Determine general order status
        $status_label = 'Processing';
        if ((int)$order['payStatus'] === 1) {
            $status_label = !empty($order['orderLabelStatus']) ? 'In Transit' : 'Confirmed & Processing';
        } elseif ((int)$order['payStatus'] === 2) {
            $status_label = 'Payment Failed';
        } elseif ((int)$order['payStatus'] === 3) {
            $status_label = 'Cash on Delivery';
        }

        $this->response(array(
            'status' => 'success',
            'data'   => array(
                'order_id'         => $order['OrderID'],
                'order_id_final'   => $order['payOrderID'],
                'order_date'       => $order['payDate'],
                'status'           => $status_label,
                'total'            => (float)$order['payTotal'],
                'customer_name'    => $order['payName'],
                'recipient_street' => $order['payStreet'] ?: $order['payAddress'],
                'recipient_suburb' => $order['paySuburb'],
                'recipient_city'   => $order['payCity'],
                'recipient_country'=> $order['payCountry'],
                'tracking_ref'     => $order['orderTrackingRef'] ?: null,
                'courier_name'     => !empty($order['orderTrackingRef']) ? 'NZ Post Express Courier' : null,
                'events'           => $tracking_events,
                'items'            => array_map(function($it) {
                    return array(
                        'id'       => $it['orderprodID'],
                        'name'     => $it['payProduct'],
                        'price'    => (float)$it['payPrice'],
                        'quantity' => (int)$it['payQuantity'],
                        'code'     => $it['payProdcode']
                    );
                }, $order_items)
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 26. AUTHENTICATED USER — GET ORDERS
    // ------------------------------------------------------------------------
    public function user_orders() {
        $user_id = $this->input->get('user_id');
        $email   = strtolower(trim($this->input->get('email')));

        if (empty($user_id) && empty($email)) {
            $this->response(array('status' => 'error', 'message' => 'User identifier is required.'), 400);
            return;
        }

        $this->db->from('dwalker_payments');
        if (!empty($user_id) && !empty($email)) {
            $this->db->group_start();
            $this->db->where('USER_ID', $user_id);
            $this->db->or_where('LOWER(payEmail)', $email);
            $this->db->group_end();
        } elseif (!empty($user_id)) {
            $this->db->where('USER_ID', $user_id);
        } else {
            $this->db->where('LOWER(payEmail)', $email);
        }
        $this->db->order_by('payID', 'DESC');
        $payments = $this->db->get()->result_array();

        $formatted = array();
        foreach ($payments as $p) {
            $items = $this->db->get_where('dwalker_order_products', array('OrderID' => $p['payID']))->result_array();

            $status_str = 'Processing';
            if ((int)$p['payStatus'] === 1) {
                $status_str = !empty($p['orderLabelStatus']) ? 'In Transit' : 'Confirmed';
            } elseif ((int)$p['payStatus'] === 3) {
                $status_str = 'Cash On Delivery';
            } elseif ((int)$p['payStatus'] === 2) {
                $status_str = 'Payment Failed';
            }

            // Map item details with product images from dwalker_product
            $mapped_items = array();
            foreach ($items as $it) {
                $prod = null;
                if (!empty($it['payProID'])) {
                    $prod = $this->db->get_where('dwalker_product', array('product_id' => $it['payProID']))->row_array();
                }
                if (!$prod && !empty($it['payProduct'])) {
                    $prod = $this->db->get_where('dwalker_product', array('product_name' => $it['payProduct']))->row_array();
                }

                $img_name = $prod ? (!empty($prod['ProductImage']) ? $prod['ProductImage'] : $prod['ProductdefaultImage']) : '';
                $img_url = $img_name ? $this->get_image_url('Products', $img_name) : '/placeholder.png';

                $mapped_items[] = array(
                    'id'       => (string)$it['pro_id'],
                    'name'     => $it['payProduct'],
                    'image'    => $img_url,
                    'price'    => (float)$it['payPrice'],
                    'quantity' => (int)$it['payQuantity'],
                    'specs'    => 'Fine Jewellery'
                );
            }

            $formatted[] = array(
                'id'              => $p['OrderID'] ?: 'DW' . $p['payID'],
                'internal_id'     => $p['payID'],
                'date'            => ($p['payDate'] && $p['payDate'] !== '0000-00-00') ? date('d M Y', strtotime($p['payDate'])) : date('d M Y'),
                'status'          => $status_str,
                'total'           => (float)$p['payTotal'],
                'subtotal'        => (float)$p['payTotalbefore'],
                'shipping'        => (float)$p['payShipping'],
                'shippingAddress' => implode(', ', array_filter([$p['payStreet'] ?: $p['payAddress'], $p['paySuburb'], $p['payCity'], $p['payCountry']])),
                'trackingNumber'  => $p['orderTrackingRef'] ?: null,
                'courier'         => !empty($p['orderTrackingRef']) ? 'NZ Post Express' : null,
                'paymentMethod'   => ((int)$p['payStatus'] === 3) ? 'Cash On Delivery' : 'Online Payment (Windcave)',
                'items'           => $mapped_items
            );
        }

        $this->response(array(
            'status' => 'success',
            'data'   => $formatted
        ));
    }

    // ------------------------------------------------------------------------
    // 27. AUTHENTICATED USER — UPDATE PROFILE (NAME, PHONE, COUNTRY, ADDRESS)
    // ------------------------------------------------------------------------
    public function update_profile() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $user_id   = isset($post['user_id']) ? trim($post['user_id']) : '';
        $fullname  = isset($post['fullname']) ? trim($post['fullname']) : '';
        $mobile_no = isset($post['mobile_no']) ? trim($post['mobile_no']) : '';
        $country   = isset($post['country']) ? trim($post['country']) : 'New Zealand';
        $address   = isset($post['address']) ? trim($post['address']) : '';

        if (empty($user_id)) {
            $this->response(array('status' => 'error', 'message' => 'User ID is required.'), 400);
            return;
        }

        if (empty($fullname)) {
            $this->response(array('status' => 'error', 'message' => 'Full name cannot be empty.'), 400);
            return;
        }

        $user = $this->db->get_where('dwalker_users', array('USER_ID' => $user_id))->row_array();
        if (!$user) {
            $this->response(array('status' => 'error', 'message' => 'User account not found.'), 404);
            return;
        }

        $update_data = array(
            'FULLNAME'  => $fullname,
            'MOBILE_NO' => $mobile_no,
            'COUNTRY'   => $country,
            'SADDRESS'  => $address
        );

        $this->db->where('USER_ID', $user_id);
        $this->db->update('dwalker_users', $update_data);

        $this->response(array(
            'status'  => 'success',
            'message' => 'Profile updated successfully.',
            'data'    => array(
                'id'        => $user['USER_ID'],
                'fullname'  => $fullname,
                'email'     => $user['EMAIL_ID'],
                'mobile_no' => $mobile_no,
                'country'   => $country,
                'address'   => $address
            )
        ));
    }

    // ------------------------------------------------------------------------
    // 28. AUTHENTICATED USER — CHANGE PASSWORD (MIN 6 CHARS & BCRYPT)
    // ------------------------------------------------------------------------
    public function change_password() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $user_id          = isset($post['user_id']) ? trim($post['user_id']) : '';
        $current_password = isset($post['current_password']) ? trim($post['current_password']) : '';
        $new_password     = isset($post['new_password']) ? trim($post['new_password']) : '';

        if (empty($user_id) || empty($current_password) || empty($new_password)) {
            $this->response(array('status' => 'error', 'message' => 'All password fields are required.'), 400);
            return;
        }

        if (strlen($new_password) < 6) {
            $this->response(array('status' => 'error', 'message' => 'New password must be at least 6 characters long.'), 400);
            return;
        }

        $user = $this->db->get_where('dwalker_users', array('USER_ID' => $user_id))->row_array();
        if (!$user) {
            $this->response(array('status' => 'error', 'message' => 'User account not found.'), 404);
            return;
        }

        // Verify current password (supports Bcrypt & legacy hashes)
        $is_valid = verify_and_upgrade_password(
            $current_password,
            $user['PASSWORD'],
            'dwalker_users',
            'USER_ID',
            $user['USER_ID'],
            'PASSWORD'
        );

        if (!$is_valid) {
            $this->response(array('status' => 'error', 'message' => 'Current password entered is incorrect.'), 400);
            return;
        }

        // Hash new password using Bcrypt
        $bcrypt_password = hash_password_secure($new_password);
        $this->db->where('USER_ID', $user_id);
        $this->db->update('dwalker_users', array('PASSWORD' => $bcrypt_password));

        $this->response(array(
            'status'  => 'success',
            'message' => 'Password has been changed successfully.'
        ));
    }

    // ------------------------------------------------------------------------
    // 27. CONTACT US INQUIRY API (Uses centralized application/config/email.php)
    // ------------------------------------------------------------------------
    public function contact_submit() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;

        // Bot protection: Honeypot check & rate limiting
        $bot_check = $this->is_bot_submission($post, 'contact_rate', 10, 600);
        if ($bot_check === true) {
            // Fake success response to deflect bot without sending email
            $this->response(array(
                'status'  => 'success',
                'message' => 'Thank you for reaching out! Your message has been sent successfully. We will get back to you shortly.'
            ));
            return;
        } elseif ($bot_check === 'rate_limited') {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Too many messages sent. Please wait a few minutes before trying again.'
            ), 429);
            return;
        }

        $name    = isset($post['name']) ? trim($post['name']) : '';
        $email   = isset($post['email']) ? trim($post['email']) : '';
        $subject = isset($post['subject']) ? trim($post['subject']) : 'Inquiry regarding jewellery';
        $message = isset($post['message']) ? trim($post['message']) : '';


        // Validation
        if (empty($name)) {
            $this->response(array('status' => 'error', 'message' => 'Your name is required.'), 400);
            return;
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->response(array('status' => 'error', 'message' => 'A valid email address is required.'), 400);
            return;
        }

        if (empty($message) || strlen($message) < 5) {
            $this->response(array('status' => 'error', 'message' => 'Please provide a message with at least 5 characters.'), 400);
            return;
        }

        // Load centralized email configuration
        $this->load->library('email');
        $this->load->config('email', TRUE);

        $from_email   = $this->config->item('from_email') ?: 'techsofttest123@gmail.com';
        $from_name    = $this->config->item('from_name') ?: 'D. Walker Jewellers';
        $admin_emails = $this->config->item('admin_emails') ?: 'dwalkerjewels@gmail.com, nair182002@gmail.com, techsofttest@gmail.com';

        // Build HTML email body
        $body = '<div style="font-family: Arial, Helvetica, sans-serif; line-height: 20px; color: #333333; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5e5e5;">
            <div style="text-align: center; padding-bottom: 15px; border-bottom: 2px solid #b79a62;">
                <h2 style="margin: 0; color: #1a365d; font-size: 22px; letter-spacing: 1px;">D. WALKER JEWELLERS</h2>
                <p style="margin: 4px 0 0 0; font-size: 11px; text-transform: uppercase; color: #b79a62; letter-spacing: 2px;">New Contact Inquiry</p>
            </div>
            <div style="padding: 20px 0;">
                <p style="font-size: 14px; margin-bottom: 16px;">You have received a new inquiry from the website contact form:</p>
                <table width="100%" cellpadding="8" cellspacing="0" style="background-color: #faf9f6; border: 1px solid #e7e5e4; font-size: 13px;">
                    <tr>
                        <td width="30%" style="font-weight: bold; border-bottom: 1px solid #e7e5e4; color: #555;">Name:</td>
                        <td style="border-bottom: 1px solid #e7e5e4;">' . htmlspecialchars($name) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; border-bottom: 1px solid #e7e5e4; color: #555;">Email:</td>
                        <td style="border-bottom: 1px solid #e7e5e4;"><a href="mailto:' . htmlspecialchars($email) . '" style="color: #071f75;">' . htmlspecialchars($email) . '</a></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; border-bottom: 1px solid #e7e5e4; color: #555;">Subject:</td>
                        <td style="border-bottom: 1px solid #e7e5e4;">' . htmlspecialchars($subject) . '</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; vertical-align: top; color: #555;">Message:</td>
                        <td style="white-space: pre-wrap;">' . nl2br(htmlspecialchars($message)) . '</td>
                    </tr>
                </table>
            </div>
            <div style="text-align: center; padding-top: 15px; border-top: 1px solid #eeeeee; font-size: 11px; color: #888888;">
                This inquiry was submitted from the D. Walker Jewellers Contact page. Reply directly to this email to reach the customer.
            </div>
        </div>';

        $this->email->clear(TRUE);
        $this->email->from($from_email, $from_name);
        $this->email->to($admin_emails);
        $this->email->reply_to($email, $name);
        $this->email->subject("New Inquiry: " . $subject . " - " . $from_name);
        $this->email->message($body);

        $sent = @$this->email->send();

        $this->response(array(
            'status'  => 'success',
            'message' => 'Thank you for reaching out! Your message has been sent successfully. We will get back to you shortly.'
        ));
    }

    // ------------------------------------------------------------------------
    // 28. NEWSLETTER SUBSCRIBE API
    // ------------------------------------------------------------------------
    public function newsletter_subscribe() {
        $post = json_decode(file_get_contents('php://input'), true) ?: $_POST;

        // Honeypot trap: bots typically fill any visible or hidden text/email fields
        $honeypot = isset($post['website_url']) ? trim($post['website_url']) : (isset($post['hp_field']) ? trim($post['hp_field']) : '');
        if (!empty($honeypot)) {
            // Silently pretend success to fool bots without storing anything
            $this->response(array(
                'status'  => 'success',
                'message' => 'Thank you for subscribing to the World of D Walker!'
            ));
            return;
        }

        // Time-based check: if form was submitted unnaturally fast (< 1.5s)
        if (isset($post['form_rendered_at']) && is_numeric($post['form_rendered_at'])) {
            $timeTaken = time() - (int)$post['form_rendered_at'];
            if ($timeTaken < 1) {
                // Too fast to be human interaction
                $this->response(array(
                    'status'  => 'success',
                    'message' => 'Thank you for subscribing to the World of D Walker!'
                ));
                return;
            }
        }

        // IP rate limiting: max 5 newsletter subscription attempts per 10 minutes
        $ip = $this->input->ip_address();
        $rate_key = 'newsletter_sub_rate_' . md5($ip);
        $attempts = (int)$this->cache->file->get($rate_key);
        if ($attempts >= 5) {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Too many requests. Please wait a few minutes before trying again.'
            ), 429);
            return;
        }
        $this->cache->file->save($rate_key, $attempts + 1, 600);

        $email = isset($post['email']) ? trim(strtolower($post['email'])) : '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Please enter a valid email address.'
            ), 400);
            return;
        }

        // Check if subscriber already exists
        $existing = $this->db->get_where('dwalker_newsletter_subscribers', array('email' => $email))->row_array();

        if ($existing) {
            if (isset($existing['status']) && (int)$existing['status'] === 0) {
                // Reactivate subscription if was previously removed/inactive
                $this->db->where('id', $existing['id']);
                $this->db->update('dwalker_newsletter_subscribers', array('status' => 1));
            }
            $this->response(array(
                'status'  => 'success',
                'message' => 'You are already subscribed to our newsletter! Thank you for being with us.'
            ));
            return;
        }

        // Insert new subscriber
        $inserted = $this->db->insert('dwalker_newsletter_subscribers', array(
            'email'      => $email,
            'created_at' => date('Y-m-d H:i:s'),
            'status'     => 1
        ));

        if ($inserted) {
            $this->response(array(
                'status'  => 'success',
                'message' => 'Thank you for subscribing to the World of D Walker!'
            ));
        } else {
            $this->response(array(
                'status'  => 'error',
                'message' => 'Failed to subscribe at this moment. Please try again later.'
            ), 500);
        }
    }

    // ------------------------------------------------------------------------
    // 29. BLOGS API (List & Detail)
    // ------------------------------------------------------------------------
    public function blogs() {
        $limit = (int)($this->input->get('limit') ?: 20);
        $page  = (int)($this->input->get('page') ?: 1);
        $offset = ($page - 1) * $limit;

        $this->db->from('dwalker_blogs');
        $this->db->where('status', 1);
        $this->db->order_by('blog_date', 'DESC');
        $this->db->order_by('id', 'DESC');

        $total_items = $this->db->count_all_results('', false);
        $this->db->limit($limit, $offset);
        $blogs = $this->db->get()->result_array();

        foreach ($blogs as &$b) {
            $b['image_url'] = $this->get_image_url('Blogs', $b['image']);
        }

        $this->response(array(
            'status' => 'success',
            'pagination' => array(
                'total_items' => $total_items,
                'current_page' => $page,
                'per_page' => $limit,
                'total_pages' => ceil($total_items / $limit)
            ),
            'data' => $blogs
        ));
    }

    public function blog_detail($slug = '') {
        if (empty($slug)) {
            $this->response(array('status' => 'error', 'message' => 'Blog slug is required'), 400);
            return;
        }

        $this->db->from('dwalker_blogs');
        $this->db->where('status', 1);
        $this->db->group_start();
        $this->db->where('slug', $slug);
        if (is_numeric($slug)) {
            $this->db->or_where('id', (int)$slug);
        }
        $this->db->group_end();
        $blog = $this->db->get()->row_array();

        if (!$blog) {
            $this->response(array('status' => 'error', 'message' => 'Blog not found'), 404);
            return;
        }

        $blog['image_url'] = $this->get_image_url('Blogs', $blog['image']);

        // Fetch other recent blogs for "More Stories"
        $this->db->from('dwalker_blogs');
        $this->db->where('status', 1);
        $this->db->where('id !=', $blog['id']);
        $this->db->order_by('blog_date', 'DESC');
        $this->db->limit(3);
        $recent = $this->db->get()->result_array();
        foreach ($recent as &$r) {
            $r['image_url'] = $this->get_image_url('Blogs', $r['image']);
        }

        $blog['recent_blogs'] = $recent;

        $this->response(array(
            'status' => 'success',
            'data'   => $blog
        ));
    }

}



