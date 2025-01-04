<?php
// Data Access Layer - Handles database operations
class NutribaseRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllTags(): array {
        $sql = "SELECT id AS TagId, name AS TagName FROM tag ORDER BY name";
        return doQuery($sql, [], $this->conn);
    }

    public function getTagById(int $tagId): array {
        $sql = "SELECT tag.name AS tagName FROM tag WHERE tag.id = ? ORDER BY tag.name";
        return doQuery($sql, [$tagId], $this->conn);
    }

    public function getFoodsByTagId(int $tagId): array {
        $sql = "SELECT food.id AS FoodId, food.name AS FoodName 
                FROM food 
                INNER JOIN tagged_food ON tagged_food.food_id = food.id 
                WHERE tagged_food.tag_id = ? 
                ORDER BY food.name";
        return doQuery($sql, [$tagId], $this->conn);
    }

    public function getFoodById(int $foodId): array {
        $sql = "SELECT id AS FoodId, name AS FoodName, 
                       kcal_per_unit AS kCal, 
                       protein_grams_per_unit AS protein, 
                       unit_caption_override AS override 
                FROM food WHERE id = ?";
        return doQuery($sql, [$foodId], $this->conn);
    }
}
