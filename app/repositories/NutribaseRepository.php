<?php
// Data Access Layer - Handles database operations
class NutribaseRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    protected function doQuery(string $sql, array $params): array {
        // Prepare the query
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }

        try {
            // Bind parameters if provided
            if (!empty($params)) {
                $types = str_repeat('s', count($params)); // Assume all parameters are strings for simplicity
                $stmt->bind_param($types, ...$params);
            }

            // Execute the query
            if (!$stmt->execute()) {
                throw new Exception("Execution error: " . $stmt->error);
            }

            // Fetch results if the query returns any
            $result = $stmt->get_result();
            return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        } finally {
            $stmt->close();
        }
    }
    
    public function getAllTags(): array {
        $sql = "SELECT id AS TagId, name AS TagName FROM tag ORDER BY name";
        return $this->doQuery($sql, [], $this->conn);
    }

    public function getTagById(int $tagId): array {
        $sql = "SELECT tag.name AS tagName FROM tag WHERE tag.id = ? ORDER BY tag.name";
        return $this->doQuery($sql, [$tagId], $this->conn);
    }

    public function getFoodsByTagId(int $tagId): array {
        $sql = "SELECT food.id AS FoodId, food.name AS FoodName 
                FROM food 
                INNER JOIN tagged_food ON tagged_food.food_id = food.id 
                WHERE tagged_food.tag_id = ? 
                ORDER BY food.name";
        return $this->doQuery($sql, [$tagId], $this->conn);
    }

    public function getFoodById(int $foodId): array {
        $sql = "SELECT id AS FoodId, name AS FoodName, 
                       kcal_per_unit AS kCal, 
                       protein_grams_per_unit AS protein, 
                       unit_caption_override AS override 
                FROM food WHERE id = ?";
        return $this->doQuery($sql, [$foodId], $this->conn);
    }
}
