<?php
use Migrations\AbstractSeed;

/**
 * Allergies seed.
 */
class AllergiesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'allergy' => 'Celery',
                'description' => 'This includes celery stalks, leaves, seeds and the root called celeriac. You can find celery in celery salt, salads, some meat products, soups and stock cubes.',
            ],
            [
                'id' => '2',
                'allergy' => 'Cereals containing gluten',
                'description' => 'Wheat (such as spelt and Khorasan wheat/Kamut), rye, barley and oats is often found in foods containing flour, such as some types of baking powder, batter, breadcrumbs, bread, cakes, couscous, meat products, pasta, pastry, sauces, soups and fried foods which are dusted with flour.',
            ],
            [
                'id' => '3',
                'allergy' => 'Crustaceans',
                'description' => 'Crabs, lobster, prawns and scampi are crustaceans. Shrimp paste, often used in Thai and south-east Asian curries or salads, is an ingredient to look out for.',
            ],
            [
                'id' => '4',
                'allergy' => 'Eggs',
                'description' => 'Eggs are often found in cakes, some meat products, mayonnaise, mousses, pasta, quiche, sauces and pastries or foods brushed or glazed with egg.',
            ],
            [
                'id' => '5',
                'allergy' => 'Fish',
                'description' => 'You will find this in some fish sauces, pizzas, relishes, salad dressings, stock cubes and Worcestershire sauce.',
            ],
            [
                'id' => '6',
                'allergy' => 'Lupin',
                'description' => 'Yes, lupin is a flower, but it’s also found in flour! Lupin flour and seeds can be used in some types of bread, pastries and even in pasta.',
            ],
            [
                'id' => '7',
                'allergy' => 'Milk',
                'description' => 'Milk is a common ingredient in butter, cheese, cream, milk powders and yoghurt. It can also be found in foods brushed or glazed with milk, and in powdered soups and sauces.',
            ],
            [
                'id' => '8',
                'allergy' => 'Molluscs',
                'description' => 'These include mussels, land snails, squid and whelks, but can also be commonly found in oyster sauce or as an ingredient in fish stews.',
            ],
            [
                'id' => '9',
                'allergy' => 'Mustard',
                'description' => 'Liquid mustard, mustard powder and mustard seeds fall into this category. This ingredient can also be found in breads, curries, marinades, meat products, salad dressings, sauces and soups.',
            ],
            [
                'id' => '10',
                'allergy' => 'Nuts',
                'description' => 'Not to be mistaken with peanuts (which are actually a legume and grow underground), this ingredient refers to nuts which grow on trees, like cashew nuts, almonds and hazelnuts. You can find nuts in breads, biscuits, crackers, desserts, nut powders (often used in Asian curries), stir-fried dishes, ice cream, marzipan (almond paste), nut oils and sauces.',
            ],
            [
                'id' => '11',
                'allergy' => 'Peanuts',
                'description' => 'Peanuts are actually a legume and grow underground, which is why it’s sometimes called a groundnut. Peanuts are often used as an ingredient in biscuits, cakes, curries, desserts, sauces (such as satay sauce), as well as in groundnut oil and peanut flour.',
            ],
            [
                'id' => '12',
                'allergy' => 'Sesame seeds',
                'description' => 'These seeds can often be found in bread (sprinkled on hamburger buns for example), breadsticks, houmous, sesame oil and tahini. They are sometimes toasted and used in salads.',
            ],
            [
                'id' => '13',
                'allergy' => 'Soya',
                'description' => 'Often found in bean curd, edamame beans, miso paste, textured soya protein, soya flour or tofu, soya is a staple ingredient in oriental food. It can also be found in desserts, ice cream, meat products, sauces and vegetarian products.',
            ],
            [
                'id' => '14',
                'allergy' => 'Sulphur dioxide (sometimes known as sulphites)',
                'description' => 'This is an ingredient often used in dried fruit such as raisins, dried apricots and prunes. You might also find it in meat products, soft drinks, vegetables as well as in wine and beer. If you have asthma, you have a higher risk of developing a reaction to sulphur dioxide.',
            ],
        ];

        $table = $this->table('allergies');
        $table->insert($data)->save();
    }
}
