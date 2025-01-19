UPDATE food
   SET food.protein_grams_per_unit = 2.5,
       food.name = 'Apricot - Dried, Alesto'
   WHERE food.name LIKE '%apricot - dried%';

-- Handling the aportrophe in Sainsbury's
UPDATE food
   SET food.name = 'Tagliatelli - Dried, Sainsbury''s'
   WHERE food.name = 'Penne';
