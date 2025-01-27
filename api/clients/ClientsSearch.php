<?php

function ClientsSearch($params, $db){
        $search = isset($params['search']) ? $params['search'] : '';
        $sort = isset($params['sort']) ? $params['sort'] : '';

        $search = trim(strtolower($search));

            $clients = $db->query(
                "SELECT * FROM clients   WHERE LOWER(name) LIKE '%$search%' ORDER BY name $sort
                ") ->fetchAll(); 
        
        // $clients = $db->query(
        // "SELECT * FROM clients
        // ") ->fetchAll();

        return $clients;
}


?>