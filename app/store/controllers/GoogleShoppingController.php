    <?php

    class GoogleShoppingController extends Controller
    {

        public function index()
        {

            $array = [
                'title' => 'https://www.lustresecia.com.br',
                'updated' => date('m/d/Y - H:i:s'),
                'lastBuildDate' => date('m/d/Y - H:i:s')
            ];

            $prods = new Products();

            $feed = $prods->getAll();

            // function defination to convert array to xml

            foreach ($feed as $item) {
                // echo "<pre>";
                // print_r($item);
                // exit;

                ($item['id'] < 10)? $cc = 0: $cc = '' ;
                ($item['stock'] > 0)? $stock = 'Disponível': $stock = 'Pré Encomenda';

                $array[] = [
                    'g:id' => $item['id'],
                    'g:title' => $item['name'],
                    'g:description' => str_replace(['<p>', '</p>'], '', $item['description']),
                    'g:link' => ROOT_URL. 'product/open/' .$item['slug'],
                    'g:image_link' => ROOT_URL . 'media/products/' .$cc.$item['id']. '/' .$item['images'][0]['url'],
                    'g:availability' => $stock,
                    'g:availability_date' => $item['shipping_days'],
                    'g:price' => $item['price_from'] . ' BRL',
                    'g:sale_price' => $item['price'] . ' BRL',
                    'g:installment' => ['g:months' => '6', 'g:amount' => number_format($item['price_from']/6, 2)],
                    'g:brand' => $item['brand_name'],
                    'g:condition' => 'Novo',
                ];
            }

            function array_to_xml( $data, &$xml_data ) {
                foreach( $data as $key => $value ) {
                    if( is_array($value) ) {
                        if( is_numeric($key) ){
                        $key = 'item'.$key; //dealing with <0/>..<n/> issues
                    }
                        $subnode = $xml_data->addChild($key);
                        array_to_xml($value, $subnode);
                    } else {
                        $xml_data->addChild("$key",htmlspecialchars("$value"));
                    }
                }
            }

            // creating object of SimpleXMLElement
            $xml_data = new SimpleXMLElement('<?xml version="1.0"?><feed xmlns:g="http://base.google.com/ns/1.0"></feed>');

                        // function call to convert array to xml
            array_to_xml($array, $xml_data);

                        //saving generated xml file;
            $result = $xml_data->asXML('products.xml');

            echo "<pre>";

            print_r($xml_data);

        }

    }
