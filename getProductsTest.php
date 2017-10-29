<?php
/**
 * Created by IntelliJ IDEA.
 * User: risto
 * Date: 26.10.2017
 * Time: 20:19
 */

class CatalogModelCatalogGetProductsTest extends OpenCartTest {

    /**
     * @before
     */
    public function setupTest() {
        $this->loadModelByRoute('catalog/product');
    }



    public function testGetAllProductsEmptyFilter() {
        $filters = array(); //set up conditions for test
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved all products');
    }

    public function testFilterCategoryIdIsZero() {
        $productsTotal = $this->model_catalog_product->getTotalProducts(array());
        $filters = array( //set up conditions for test
            'filter_category_id' => 0,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_category_id=0');
    }

    public function testFilterCategoryIdIsNull() {
        $productsTotal = $this->model_catalog_product->getTotalProducts(array());
        $filters = array( //set up conditions for test
            'filter_category_id' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_category_id=>null, all products');
    }

    public function testFilterCategoryIdIsRandomString() {
        $filters = array( //set up conditions for test
            'filter_category_id' => 'string',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == 0, sizeof($products) . ' Retrieved from filter_category_id=>"string", 0 products');
    }

    public function testFilterCategoryIdIsExistingId() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' =>$allCategories[0]['category_id'],
        );
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_category_id=>'.$allCategories[0]['category_id'].', 1 products');
    }



    public function testFilterSubCategoryNull() {
        //FILTER_SUB_CATEGORY IS ONLY CHECKED IF EXISTS, NO VALUE USAGES
        $filters = array( //set up conditions for test
            'filter_category_id' => 'true', //necessary to access filter_sub_category
            'filter_sub_category' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == 0, sizeof($products) . ' Retrieved from filter_sub_category=>null, 0 products');
    }

    public function testFilterSubCategoryNullCatIdExisting() {
        //FILTER_SUB_CATEGORY IS ONLY CHECKED IF EXISTS, NO VALUE USAGES
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_sub_category
            'filter_sub_category' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_sub_category=>null,');
    }

    public function testFilterSubCategoryNotEmpty() {
        //FILTER_SUB_CATEGORY IS ONLY CHECKED IF EXISTS, NO VALUE USAGES
        $filters = array( //set up conditions for test
            'filter_category_id' => 'true', //necessary to access filter_sub_category
            'filter_sub_category' => 'true',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_sub_category=>"true", 0 products');
    }

    public function testFilterSubCategoryNotEmptyExistingCategoryId() {
        //FILTER_SUB_CATEGORY IS ONLY CHECKED IF EXISTS, NO VALUE USAGES
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_sub_category
            'filter_sub_category' => 'true',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_sub_category=>"true", filter_category_id=>27, 1 products');
    }

    public function testFilterFilterNullExistingCategoryId() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_filter' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>null');

    }

    public function testFilterFilterTrueCategoryIdExisting() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_filter' => 'true',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>"true", filter_category_id=>20, 0 products');
    }

    public function testFilterFilterIsZero() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_filter' => 0,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>0, filter_category_id=>20, 12 products');
    }

    public function testFilterFilterIsZeroFive() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_filter' => "0,5",
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>"0,5", filter_category_id=>20, 0 products');

    }

    public function testFilterFilterIsNullAndSubCategoryIsNull() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_sub_category' => null,
            'filter_filter' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>null,filter_sub_category=>null,filter_category_id=>20, 12 products');
    }

    public function testFilterFilterIsNullAndSubCategoryIsRandomString() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_sub_category' => 'randomString',
            'filter_filter' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>null,filter_sub_category=>"randomString",filter_category_id=>20, 13 products');
    }

    public function testFilterFilterIsRandomStringAndSubCategoryIsNull() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_sub_category' => null,
            'filter_filter' => 'randomString',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>"randomString",filter_sub_category=>null,filter_category_id=>20, 0 products');

    }

    public function testFilterFilterIsZeroAndSubCategoryIsRandomString() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_sub_category' => 'randomString',
            'filter_filter' => '0',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>"0",filter_sub_category=>"randomString",filter_category_id=>20, 13 products');

    }

    public function testFilterFilterIsExistingCategoryAndSubCategoryIsRandomString() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_sub_category' => 'randomString',
            'filter_filter' => $allCategories[0]['category_id'].'',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>"20",filter_sub_category=>"true,filter_category_id=>20, 0 products');
    }

    public function testFilterFilterIsZeroAndSubCategoryIsNull() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_sub_category' => null,
            'filter_filter' => '0',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>"0",filter_sub_category=>null,filter_category_id=>20, 12 products');
    }

    public function testFilterFilterIsExsistingCategoryAndSubCategoryIsNull() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_sub_category' => null,
            'filter_filter' => $allCategories[0]['category_id'].'',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_filter=>"20",filter_sub_category=>null,filter_category_id=>20, 0 products');
    }


    public function testFilterNameIsNull() {
        $filters = array( //set up conditions for test
            'filter_name' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>null, 19 products');
    }

    public function testFilterNameIsan() {
        $filters = array( //set up conditions for test
            'filter_name' => 'a n',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>"a n", 6 products');
    }

    public function testFilterNameIsanFilterDescriptionIsRandomString() {
        $filters = array( //set up conditions for test
            'filter_name' => 'a n',
            'filter_description' => 'randomString'
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>"a n",filter_description=>"randomString", 10 products');
    }

    public function testFilterNameIsNullFilterDescriptionIsRandomString() {
        $filters = array( //set up conditions for test
            'filter_name' => null,
            'filter_description' => 'randomString'
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>null,filter_description=>"true", 19 products');
    }

    public function testFilterTagIsNull() {
        $filters = array( //set up conditions for test
            'filter_tag' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_tag=>null, 19 products');
    }

    public function testFilterTagIsExistingTag() {
        $filters = array( //set up conditions for test
            'filter_tag' => 'car',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_tag=>"car", 8 products');
    }

    public function testFilterTagIsRandomString() {
        $filters = array( //set up conditions for test
            'filter_tag' => 'randomString',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_tag=>"randomString", 0 products');
    }

    public function testFilterNameIsanFilterTagIsExistingTag() {
        $filters = array( //set up conditions for test
            'filter_name' => 'a n',
            'filter_tag' => 'car',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>"a n"filter_tag=>"car", 13 products');
    }

    public function testFilterNameIsAnFilterTagIsExistingTagFilterDescriptionIsRandomString() {
        $filters = array( //set up conditions for test
            'filter_name' => 'a n',
            'filter_description' => 'randomString',
            'filter_tag' => 'car',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>"a n",filter_description=>"randomString"filter_tag=>"car", 15 products');
    }

    public function testFilterManufacturerIdIsNull() {
        $filters = array( //set up conditions for test
            'filter_manufacturer_id' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_manufacturer_id=>null, 19 products');
    }

    public function testFilterManufacturerIdIsEmptyString() {
        $filters = array( //set up conditions for test
            'filter_manufacturer_id' => '',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_manufacturer_id=>"", 19 products');
    }

    public function testFilterManufacturerIdIsExistingManufacturer() {
        $filters = array( //set up conditions for test
            'filter_manufacturer_id' => '8',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);
        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_manufacturer_id=>"8", 10 products');
        foreach ($products as $product) {
            $this->assertTrue($product['manufacturer_id'] == 8, sizeof($products) . ' Retrieved from filter_manufacturer_id=>"8"');
        }
    }

    public function testFilterManufacturerIdIsNotExistingManufacturer() {
        $filters = array( //set up conditions for test
            'filter_manufacturer_id' => '0',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_manufacturer_id=>"7800", 0 products');
    }

    public function testSortIsNull() {
        $filters = array( //set up conditions for test
            'sort' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $productsAll = $this->model_catalog_product->getProducts(array());
        $productsAllIds = array_keys($productsAll);
        $i = 0;
        foreach ($productsIds as $productId) {
            $this->assertTrue($productId == $productsAllIds[$i], sizeof($products) . 'Index='.$i.', product_id='.$productId.', array_id='.$productsAllIds[$i] . ' sort=null');
            $i ++;
        }
    }

    public function testSortIsRandomString() {
        $filters = array( //set up conditions for test
            'sort' => 'randomString',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $productsAll = $this->model_catalog_product->getProducts(array());
        $productsAllIds = array_keys($productsAll);
        $i = 0;
        foreach ($productsIds as $productId) {
            $this->assertTrue($productId == $productsAllIds[$i], sizeof($products) . 'Index='.$i.', product_id='.$productId['product_id'].', array_id='.$productsAllIds[$i] . ' sort="aaa"');
            $i ++;
        }
    }

    public function testSortIsPdName() {
        $filters = array( //set up conditions for test
            'sort' => 'pd.name',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $i = 0;
        $oldProduct = null;
        foreach ($products as $product) {
            if ($oldProduct != null) {
                $this->assertTrue($product['name'] >= $oldProduct['name'], sizeof($products) . 'Index='.$i.', product_id='.$product['product_id'].', array_id='.$productsIds[$i] . ' sort="pd.name"');
                $i ++;
            } else {
                $oldProduct = $product;
            }

        }
    }

    public function testSortIsPModel() {
        $filters = array( //set up conditions for test
            'sort' => 'p.model',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $i = 0;
        $oldProduct = null;
        foreach ($products as $product) {
            if ($oldProduct != null) {
                $this->assertTrue($product['model'] >= $oldProduct['model'], sizeof($products) . 'Index='.$i.', product_id='.$product['product_id'].', array_id='.$productsIds[$i] . ' sort="p.model"');
                $i ++;
            } else {
                $oldProduct = $product;
            }

        }
    }

    public function testSortIsPrice() {
        $filters = array( //set up conditions for test
            'sort' => 'p.price',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $i = 0;
        $oldProduct = null;
        foreach ($products as $product) {
            if ($oldProduct != null) {
                if ($product['special'] != null) {
                    if ($oldProduct['special'] != null) {
                        $this->assertTrue($product['special'] >= $oldProduct['special'], sizeof($products) . 'Index='.$i.', product_special='.$product['special'].', old_special='.$oldProduct['special']. ' sort="special"');
                    } else {
                        $this->assertTrue($product['special'] >= $oldProduct['price'], sizeof($products) . 'Index='.$i.', product_special='.$product['special'].', old_special='.$oldProduct['special']. ' sort="special"');
                    }
                } else {
                    if ($oldProduct['special'] != null) {
                        $this->assertTrue($product['price'] >= $oldProduct['special'], sizeof($products) . 'Index='.$i.', product_price='.$product['price'].', old_price='.$oldProduct['price']. ', old_special='.$oldProduct['special'].' sort="p.price"');
                    } else {
                        $this->assertTrue($product['price'] >= $oldProduct['price'], sizeof($products) . 'Index='.$i.', product_price='.$product['price'].', old_price='.$oldProduct['price']. ', old_special='.$oldProduct['special'].' sort="p.price"');
                    }
                }
                $i ++;
            } else {
                $oldProduct = $product;
            }
        }
    }

    public function testSortIsRating() {
        $filters = array( //set up conditions for test
            'sort' => 'rating',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $i = 0;
        $oldProduct = null;
        foreach ($products as $product) {
            if ($oldProduct != null) {
                $this->assertTrue($product['rating'] >= $oldProduct['rating'], sizeof($products) . 'Index='.$i.', product_id='.$product['product_id'].', array_id='.$productsIds[$i] . ' sort="rating"');
                $i ++;
            } else {
                $oldProduct = $product;
            }
        }
    }

    public function testOrderIsDesc() {
        $filters = array( //set up conditions for test
            'order' => 'DESC',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $i = 0;
        $oldProductId = null;
        foreach ($productsIds as $productId) {
            if ($oldProductId != null) {
                $this->assertTrue($productId <= $oldProductId, sizeof($products) . 'Index='.$i.', product_id='.$productId.', array_id='.$productsIds[$i] . ' order="desc"');
                $i ++;
            } else {
                $oldProductId = $productId;
            }

        }
    }

    public function testOrderIsNull() {
        $filters = array( //set up conditions for test
            'order' => null,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $productsAll = $this->model_catalog_product->getProducts(array());
        $productsAllIds = array_keys($productsAll);
        $i = 0;
        foreach ($products as $product) {
            $this->assertTrue($product['product_id'] == $productsAll[$productsAllIds[$i]]['product_id'], sizeof($products) . 'Index='.$i.', product_id='.$product['product_id'].', array_id='.$productsIds[$i] . ' order="null"');
            $i ++;
        }
    }

    public function testOrderIsRandomString() {
        $filters = array( //set up conditions for test
            'order' => 'randomString',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsIds = array_keys($products);
        $productsAll = $this->model_catalog_product->getProducts(array());
        $productsAllIds = array_keys($productsAll);
        $i = 0;
        foreach ($products as $product) {
            $this->assertTrue($product['product_id'] == $productsAll[$productsAllIds[$i]]['product_id'], sizeof($products) . 'Index='.$i.', product_id='.$product['product_id'].', array_id='.$productsIds[$i] . ' order="byCars"');
            $i ++;
        }
    }

    public function testStartIsZero() {
        $filters = array( //set up conditions for test
            'start' => 0,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved start=0 19 products');
    }

    public function testLimitIsZero() {
        $filters = array( //set up conditions for test
            'limit' => 0,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == 0, sizeof($products) . ' Retrieved limit=0 19 products');
    }

    public function testStartIsMinusOneLimitIsFive() {
        $filters = array( //set up conditions for test
            'start' => -1,
            'limit' => 5,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == 5, sizeof($products) . ' Retrieved start=-1,limit=5 5 products');
    }

    public function testStartIsMinusOneLimitIsZero() {
        $filters = array( //set up conditions for test
            'start' => -1,
            'limit' => 0,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved start=-1,limit=0 19 products');
    }

    public function testStartIsZeroLimitIsZero()
    {
        $filters = array( //set up conditions for test
            'start' => 0,
            'limit' => 0,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved start=0,limit=0 19 products');
    }

    public function testStartIsRandomStringLimitIsFive() {
        $filters = array( //set up conditions for test
            'start' => 'sdf',
            'limit' => 5,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == 5, sizeof($products) . ' Retrieved from start="sdf", limit=5, 5 products');
    }

    public function testStartIsZeroLimitIsRandomString() {
        $filters = array( //set up conditions for test
            'start' => 0,
            'limit' => 'sdf',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from dtart=0,limit="sdf", all 19 products');
    }

    public function testStartIsOneLimitIsTen() {
        $filters = array( //set up conditions for test
            'start' => 1,
            'limit' => 10,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $this->assertTrue(sizeof($products) == 10, sizeof($products) . ' Retrieved from start=1,limit=10, 10 products');
    }

    public function testStartIsOneLimitIsMinusOne() {
        $filters = array( //set up conditions for test
            'start' => 0,
            'limit' => -1,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts(array());
        if ($productsTotal < 20) {
            $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from start=1,limit=-1, '.$productsTotal.' products');
        } else {
            $this->assertTrue(sizeof($products) == 20, sizeof($products) . ' Retrieved from start=1,limit=-1, 20 products');
        }
    }

    public function testFilterNameIsAnFilterDescriptionIsRandomStringSortIsNameOrderIsDesc() {
        $filters = array( //set up conditions for test
            'filter_name' => 'a n',
            'filter_description' => 'randomString',
            'sort' => 'pd.name',
            'order' => 'DESC',
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>"a n",filter_description=>"randomString"filter_tag=>"car", 15 products');

        $i = 0;
        $oldProduct = null;
        foreach ($products as $product) {
            if ($oldProduct != null) {
                $this->assertTrue(strtolower($product['name']) <= strtolower($oldProduct['name']), sizeof($products) . 'Index='.$i.', product_name='.$product['name'].', old_product name='.$oldProduct['name'] . ' FullFlowTest');
                $i ++;
            } else {
                $oldProduct = $product;
            }
        }
    }

    public function testFilterCategoryIdIsExistingFilterNameIsAnSortIsNameStartIs0LimitIs10() {
        $allCategories = $this->model_catalog_product->getAllCategories(); //run conditions on getProducts method
        $filters = array( //set up conditions for test
            'filter_category_id' => $allCategories[0]['category_id'], //necessary to access filter_filter
            'filter_name' => 'sony',
            'sort' => 'pd.name',
            'start' => 0,
            'limit' => 10,
        );
        $products = $this->model_catalog_product->getProducts($filters); //run conditions on getProducts method
        $productsTotal = $this->model_catalog_product->getTotalProducts($filters);

        $this->assertTrue(sizeof($products) == $productsTotal, sizeof($products) . ' Retrieved from filter_name=>"a n",filter_description=>"randomString"filter_tag=>"car", 15 products');

        $i = 0;
        $oldProduct = null;
        foreach ($products as $product) {
            if ($oldProduct != null) {
                $this->assertTrue(strtolower($product['name']) >= strtolower($oldProduct['name']), sizeof($products) . 'Index='.$i.', product_name='.$product['name'].', old_product name='.$oldProduct['name'] . ' FullFlowTest');
                $i ++;
            } else {
                $oldProduct = $product;
            }
        }
    }


}