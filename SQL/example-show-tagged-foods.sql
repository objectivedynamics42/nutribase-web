SELECT 
    food.id as FoodId,
    food.name AS FoodName,
    food.kcal_per_unit as kCal,
    food.protein_grams_per_unit as Protein,
    tag.name AS TagName
FROM 
    tagged_food
INNER JOIN 
    food ON tagged_food.food_id = food.id
INNER JOIN 
    tag ON tagged_food.tag_id = tag.id
 WHERE
    food.name like '%fig%'
ORDER BY 
    food.name, tag.name;
