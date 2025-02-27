<?php

function ProductsSearch($params, $db){
        $search = isset($params['search']) ? $params['search'] : '';
        $sort = isset($params['sort']) ? $params['sort'] : '';
        $search_name = isset($params['search_name']) ? $params['search_name'] : 'name';
       // $filter = ; 
       $maxProducts = isset($_SESSION['maxProducts']) ? $_SESSION['maxProducts'] : 5;
       $offset = isset($_SESSION['offset']) ? $_SESSION['offset'] : 0;
   
       // Убедитесь, что offset не отрицательный
       $offset = max(0, $offset);
        $search = trim(strtolower($search));
        if ($sort) {
                $sort = "ORDER BY $search_name $sort";
            } 

            $products = $db->query(
                "SELECT * FROM products  WHERE LOWER(name) LIKE '%$search%' $sort LIMIT $maxProducts OFFSET $offset
                ") ->fetchAll(); 
        

        return $products;

        
}


?>