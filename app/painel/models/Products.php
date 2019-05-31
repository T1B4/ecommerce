<?php

class Products extends Model {

    public function insert($cat, $brand, $code, $name, $desc, $stock, $shipping, $price, $price_from, $rating, $featured, $sale, $bestseller, $new_prod, $weight, $width, $height, $length, $diameter, $slug, $frete) {

        $sql = $this->db->prepare("INSERT INTO products
            (id_category, id_brand, code, name, description, stock, shipping_days, price, price_from, rating, featured, sale, bestseller, new_product, weight, width, height, length, diameter, slug, frete)
            VALUES
            (:id_category, :id_brand, :code, :name, :description, :stock, :shipping_days, :price, :price_from, :rating, :featured, :sale, :bestseller, :new_product, :weight, :width, :height, :length, :diameter, :slug, :fretegratis)");
        $sql->bindValue(":id_category", $cat);
        $sql->bindValue(":id_brand", $brand);
        $sql->bindValue(":code", $code);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":description", $desc);
        $sql->bindValue(":stock", $stock);
        $sql->bindValue(":shipping_days", $shipping);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":price_from", $price_from);
        $sql->bindValue(":rating", $rating);
        $sql->bindValue(":featured", $featured);
        $sql->bindValue(":sale", $sale);
        $sql->bindValue(":bestseller", $bestseller);
        $sql->bindValue(":new_product", $new_prod);
        $sql->bindValue(":weight", $weight);
        $sql->bindValue(":width", $width);
        $sql->bindValue(":height", $height);
        $sql->bindValue(":length", $length);
        $sql->bindValue(":diameter", $diameter);
        $sql->bindValue(":fretegratis", $frete);
        $sql->bindValue(":slug", $slug);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function update($cat, $brand, $code, $name, $desc, $stock, $shipping, $price, $price_from, $rating, $featured, $sale, $bestseller, $new_prod, $weight, $width, $height, $length, $diameter, $id, $frete) {

        $sql = $this->db->prepare("UPDATE products SET id_category = :id_category, id_brand = :id_brand, code = :code, name = :name, description = :description, stock = :stock, shipping_days = :shipping_days, price = :price, price_from = :price_from, rating = :rating, featured = :featured, sale = :sale, bestseller = :bestseller, new_product = :new_product, weight = :weight, width = :width, height = :height, length = :length, diameter = :diameter, frete = :fretegratis WHERE id = :id");
        $sql->bindValue(":id_category", $cat);
        $sql->bindValue(":id_brand", $brand);
        $sql->bindValue(":code", $code);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":description", $desc);
        $sql->bindValue(":stock", $stock);
        $sql->bindValue(":shipping_days", $shipping);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":price_from", $price_from);
        $sql->bindValue(":rating", $rating);
        $sql->bindValue(":featured", $featured);
        $sql->bindValue(":sale", $sale);
        $sql->bindValue(":bestseller", $bestseller);
        $sql->bindValue(":new_product", $new_prod);
        $sql->bindValue(":weight", $weight);
        $sql->bindValue(":width", $width);
        $sql->bindValue(":height", $height);
        $sql->bindValue(":length", $length);
        $sql->bindValue(":diameter", $diameter);
        $sql->bindValue(":fretegratis", $frete);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function del($id) {
        $sql = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM products_images WHERE id_product = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function updateStock($id, $qtde) {
        $sql = $this->db->prepare("UPDATE products SET stock = (stock + :qtde) WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':qtde', $qtde);
        $sql->execute();
    }

    public function updateOptions($id, $options) {
        $sql = $this->db->prepare("UPDATE products SET options = :options WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':options', $options);
        $sql->execute();
    }

    public function getInfo($id) {
        $array = array();

        $sql = "SELECT * FROM products WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $array = $sql->fetch();
            $images = current($this->getImagesByProductId($id));
            $array['image'] = $images['url'];
            $array['imagens'] = $this->getImagesByProductId($id);
            $array['product_options'] = $this->getOptionsByProductId($id);
        }

        return $array;
    }

    public function getAvailableOptions($filters = array()) {
        $groups = array();
        $ids = array();

        $where = $this->buildWhere($filters);

        $sql = "SELECT
        id, options
        FROM products
        WHERE " . implode(' AND ', $where);
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters, $sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            foreach ($sql->fetchAll() as $product) {
                $ops = explode(",", $product['options']);
                $ids[] = $product['id'];
                foreach ($ops as $op) {
                    if (!in_array($op, $groups)) {
                        $groups[] = $op;
                    }
                }
            }
        }

        $options = $this->getAvailableValuesFromOptions($groups, $ids);

        return $options;
    }

    public function getAvailableValuesFromOptions($groups, $ids) {
        $array = array();
        $options = new Options();
        foreach ($groups as $op) {
            $array[$op] = array(
                'name' => $options->getName($op),
                'options' => array()
            );
        }

        $sql = "SELECT
        p_value,
        id_option,
        COUNT(id_option) as c
        FROM products_options
        WHERE
        id_option IN ('" . implode("','", $groups) . "') AND
        id_product IN ('" . implode("','", $ids) . "')
        GROUP BY p_value, id_option ORDER BY id_option";

        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            foreach ($sql->fetchAll() as $ops) {

                $array[$ops['id_option']]['options'][] = array(
                    'id' => $ops['id_option'],
                    'value' => $ops['p_value'],
                    'count' => $ops['c']
                );
            }
        }

        return $array;
    }

    public function getSaleCount($filters = array()) {
        $where = $this->buildWhere($filters);

        $where[] = 'sale = "1"';

        $sql = "SELECT
        COUNT(*) as c
        FROM products
        WHERE " . implode(' AND ', $where);
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters, $sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['c'];
        } else {
            return '0';
        }
    }

    public function getMaxPrice($filters = array()) {

        $sql = "SELECT
        price
        FROM products
        ORDER BY price DESC
        LIMIT 1";
        $sql = $this->db->prepare($sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['price'];
        } else {
            return '0';
        }
    }

    public function getListOfStars($filters = array()) {
        $array = array();

        $where = $this->buildWhere($filters);

        $sql = "SELECT
        rating,
        COUNT(id) as c
        FROM products
        WHERE " . implode(' AND ', $where) . "
        GROUP BY rating";
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters, $sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getListOfBrands($filters = array()) {
        $array = array();

        $where = $this->buildWhere($filters);

        $sql = "SELECT
        id_brand,
        COUNT(id) as c
        FROM products
        WHERE " . implode(' AND ', $where) . "
        GROUP BY id_brand";
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters, $sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getList($offset = 0, $limit = 3, $filters = array(), $random = false) {
        $array = array();

        $orderBySQL = '';
        if ($random == true) {
            $orderBySQL = "ORDER BY RAND()";
        }

        if (!empty($filters['toprated'])) {
            $orderBySQL = "ORDER BY rating DESC";
        }

        $where = $this->buildWhere($filters);

        $sql = "SELECT
        *,
        ( select brands.name from brands where brands.id = products.id_brand ) as brand_name,
        ( select categories.name from categories where categories.id = products.id_category ) as category_name
        FROM
        products
        WHERE " . implode(' AND ', $where) . "
        " . $orderBySQL . "
        LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters, $sql);

        $sql->execute();
        if ($sql->rowCount() > 0) {

            $array = $sql->fetchAll();

            foreach ($array as $key => $item) {

                $array[$key]['images'] = $this->getImagesByProductId($item['id']);
            }
        }

        return $array;
    }

    public function getTotal($filters = array()) {

        $where = $this->buildWhere($filters);

        $sql = "SELECT
        COUNT(*) as c
        FROM products
        WHERE " . implode(' AND ', $where);
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters, $sql);

        $sql->execute();
        $sql = $sql->fetch();

        return $sql['c'];
    }

    public function getImagesByProductId($id) {
        $array = array();

        $sql = "SELECT url FROM products_images WHERE id_product = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    private function buildWhere($filters) {
        $where = array(
            '1=1'
        );

        if (!empty($filters['category'])) {
            $where[] = "id_category = :id_category";
        }

        if (!empty($filters['brand'])) {
            $where[] = "id_brand IN ('" . implode("','", $filters['brand']) . "')";
        }

        if (!empty($filters['star'])) {
            $where[] = "rating IN ('" . implode("','", $filters['star']) . "')";
        }

        if (!empty($filters['sale'])) {
            $where[] = "sale = '1'";
        }

        if (!empty($filters['featured'])) {
            $where[] = "featured = '1'";
        }

        if (!empty($filters['options'])) {
            $where[] = "id IN (select id_product from products_options where products_options.p_value IN ('" . implode("','", $filters['options']) . "'))";
        }

        if (!empty($filters['slider0'])) {
            $where[] = "price >= :slider0";
        }

        if (!empty($filters['slider1'])) {
            $where[] = "price <= :slider1";
        }

        if (!empty($filters['searchTerm'])) {
            $where[] = "products.name LIKE :searchTerm OR code LIKE :searchTerm";
        }

        return $where;
    }

    private function bindWhere($filters, &$sql) {
        if (!empty($filters['category'])) {
            $sql->bindValue(":id_category", $filters['category']);
        }

        if (!empty($filters['slider0'])) {
            $sql->bindValue(":slider0", $filters['slider0']);
        }

        if (!empty($filters['slider1'])) {
            $sql->bindValue(":slider1", $filters['slider1']);
        }

        if (!empty($filters['searchTerm'])) {
            $sql->bindValue(":searchTerm", '%' . $filters['searchTerm'] . '%');
        }
    }

    public function getProductInfo($id) {
        $array = array();

        if (!empty($id)) {

            $sql = "SELECT
            *,
            ( select brands.name from brands where brands.id = products.id_brand ) as brand_name
            FROM products WHERE slug = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {

                $array = $sql->fetch();
            }
        }

        return $array;
    }

    public function getOptionsByProductId($id) {
        $options = array();

        // Etapa 1 - Pegar os nomes das opções.
        $sql = "SELECT options FROM products WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $options = $sql->fetch();
            $options = $options['options'];

            if (!empty($options)) {
                $sql = "SELECT * FROM options WHERE id IN (" . $options . ")";
                $sql = $this->db->query($sql);
                $options = $sql->fetchAll();
            }

            // Etapa 2 - Pegar os valores das opções
            $sql = "SELECT * FROM products_options WHERE id_product = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
            $options_values = array();
            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $op) {
                    $options_values[$op['id_option']] = $op['p_value'];
                }
            }

            // Etapa 3 - Juntar tudo em um único array.
            foreach ($options as $ok => $op) {
                if (isset($options_values[$op['id']])) {
                    $options[$ok]['value'] = $options_values[$op['id']];
                } else {
                    $options[$ok]['value'] = '';
                }
            }
        }

        return $options;
    }

    public function getRates($id, $qt) {
        $array = array();

        $rates = new Rates();
        $array = $rates->getRates($id, $qt);

        return $array;
    }

    public function getFullList($offset = 0, $limit = 20, $filters = array(), $random = false) {
        $array = array();

        $orderBySQL = '';
        if ($random == true) {
            $orderBySQL = "ORDER BY RAND()";
        }

        if (!empty($filters['toprated'])) {
            $orderBySQL = "ORDER BY rating DESC";
        }

        $where = $this->buildWhere($filters);

        // $sql = "SELECT products.*, categories.name as category_name, brands.name as brand_name FROM products INNER JOIN brands on (products.id_brand = brands.id) INNER JOIN categories on (products.id_category = categories.id) WHERE " . implode(' AND ', $where) . "
        // " . $orderBySQL . "
        // LIMIT $offset, $limit";

        $sql = "SELECT
            *,
        ( select brands.name from brands where brands.id = products.id_brand ) as brand_name,
        ( select categories.name from categories where categories.id = products.id_category ) as category_name
        FROM
        products
        WHERE " . implode(' AND ', $where) . "
        " . $orderBySQL . "
        LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters, $sql);

        $sql->execute();
        if ($sql->rowCount() > 0) {

            $array = $sql->fetchAll();

            foreach ($array as $key => $item) {

                $array[$key]['images'] = $this->getImagesByProductId($item['id']);
            }
        }

        return $array;
    }

    public function getStockList()
    {
        $data = [];

        $sql = $this->db->prepare("SELECT code, name, price, price_from, stock FROM products ORDER BY id ASC");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }

        return $data;
    }

    public function getProdStatus($id)
    {

        $data = [];

        $sql = $this->db->prepare("SELECT status FROM products WHERE id = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
        }

        return $data;
    }

    public function setProdStatus($id, $status)
    {
        $sql = $this->db->prepare("UPDATE products SET status = :status WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':status', $status);
        $sql->execute();
    }

}
