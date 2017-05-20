<?php
// Routes

use \Slim\Http\Request;
use \Slim\Http\Response;

$app->get('/customers/{id}', function(Request $request, Response $response) {

    $customersData = file_get_contents('../data/customers.json');
    $customers = json_decode($customersData, true);

    $customerId = $request->getAttribute('id');

    foreach($customers as $customer) {
        if ($customer['id'] == $customerId) {
            return $response->withJson($customer, 200);
        }
    }

    return $response->withStatus(404, 'Customer not found');
});

$app->group('/products', function () {

    $this->get('', function (Request $request, Response $response, $args) {

        $productsData = file_get_contents('../data/products.json');
        $products = json_decode($productsData, true);

        if (!is_null($products)) {
            return $response->withJson($products, 200);
        }

        return $response->withStatus(404, 'Products not found');
    });


    $this->get('/{id}', function (Request $request, Response $response, $args) {

        $productsData = file_get_contents('../data/products.json');
        $products = json_decode($productsData, true);

        $productId = $request->getAttribute('id');

        foreach($products as $product) {
            if ($product['id'] == $productId) {
                return $response->withJson($product, 200);
            }
        }

        return $response->withStatus(404, 'Product not found');
    });

});
