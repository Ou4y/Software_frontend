<?php

class SomeController {
    public function someMethod() {
        // Get the database connection
        $db = Database::getInstance()->getConnection();

        // Example of performing a query
        $query = $db->prepare("SELECT * FROM Users");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // Pass the result to the view or process it
        return $result;
    }
}
