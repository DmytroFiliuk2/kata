<?php

require_once 'bootstrap.php';

use src\Services\ItemService;


$service = new ItemService($entityManager);

echo json_encode($service->getAllItems());