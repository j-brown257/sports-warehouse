<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('category')->insert([
            ['categoryId' => 1, 'categoryName' => 'Shoes'],
            ['categoryId' => 2, 'categoryName' => 'Helmets'],
            ['categoryId' => 3, 'categoryName' => 'Pants'],
            ['categoryId' => 4, 'categoryName' => 'Tops'],
            ['categoryId' => 5, 'categoryName' => 'Balls'],
            ['categoryId' => 6, 'categoryName' => 'Equipment'],
            ['categoryId' => 7, 'categoryName' => 'Training Gear'],
            ['categoryId' => 8, 'categoryName' => 'Sale'],
        ]);

        DB::table('item')->insert([
            ['itemId' => 1, 'brand' => 'Adidas', 'itemName' => 'Adidas Euro16 Top Soccer Ball', 'photo' => 'soccerBall.jpg', 'price' => 46.00, 'salePrice' => 35.95, 'description' => 'adidas Performance Euro 16 Official Match Soccer Ball, Size 5, White/Bright Blue/Solar', 'featured' => 1, 'categoryId' => 5],
            ['itemId' => 2, 'brand' => 'Pro-tec', 'itemName' => 'Pro-tec Classic Skate Helmet', 'photo' => 'skateHelmet.jpg', 'price' => 70.00, 'salePrice' => 0.00, 'description' => 'Get the classic Pro-Tec look with proven protection. Shop a wide range of skate, bmx & water helmets online at Pro-Tec Australia.', 'featured' => 1, 'categoryId' => 2],
            ['itemId' => 3, 'brand' => 'Nike', 'itemName' => 'Nike sport 600ml Water Bottle', 'photo' => 'waterBottle.jpg', 'price' => 17.50, 'salePrice' => 15.00, 'description' => 'Rehydrate your body and revive your day with the Nike Sport 600ml Water Bottle. The asymmetrical, one-hand design provides easy grasping while the leakproof valve to prevent leakage. ', 'featured' => 1, 'categoryId' => 6],
            ['itemId' => 4, 'brand' => 'String', 'itemName' => 'String ArmaPlus Boxing Gloves', 'photo' => 'boxingGloves.jpg', 'price' => 79.95, 'salePrice' => null, 'description' => 'Get the perfect hand feel with the anatomically designed square shouldered mould to help you feel every shot land.', 'featured' => 1, 'categoryId' => 7],
            ['itemId' => 5, 'brand' => 'Asics', 'itemName' => "Asics Gel Lethal Tigreor 8 IT Men's", 'photo' => 'footyBoots.jpg', 'price' => 160.00, 'salePrice' => null, 'description' => 'The GEL-Lethal Tigreor 8 IT is an advanced lightweight football boot designed for high performance and speed. This boot features HG10mm technology.', 'featured' => 1, 'categoryId' => 1],
            ['itemId' => 6, 'brand' => 'Asics', 'itemName' => 'Asics GEL Kayano 27 Kids Running Shoes', 'photo' => 'runningShoes.jpg', 'price' => 179.99, 'salePrice' => null, 'description' => 'Asics refine running for the next generation of young athletes with the Asics GEL Kayano 27. The exceptional support and comfort of the Kayano return in a lighter even more comfortable runner thanks to the two-piece, Flightfoam Propel midsole. ', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 7, 'brand' => 'Adidas', 'itemName' => 'Adidas must have stripes tee', 'photo' => 'blackTop.jpg', 'price' => 34.99, 'salePrice' => null, 'description' => 'Built for busy training schedules, the adidas Boys Aeroready 3-Stripes Tee is a must have for budding young athletes.', 'featured' => 0, 'categoryId' => 4],
            ['itemId' => 8, 'brand' => 'Nike', 'itemName' => 'Nike girls Futura Air tee', 'photo' => 'whitePinkTop.jpg', 'price' => 29.99, 'salePrice' => 24.99, 'description' => 'Your child will be motivated to perform her best at training in the Nike Girls Futura Air Tee. The comfortable, non-restrictive crew neckline offers durability, while the iconic Nike Air logo is featured across the front and on the sleeve to highlight her sporty vibe.', 'featured' => 0, 'categoryId' => 4],
            ['itemId' => 9, 'brand' => 'Adidas', 'itemName' => 'Adidas 3 stripes flare pants', 'photo' => 'tracksuit.jpg', 'price' => 69.99, 'salePrice' => 50.00, 'description' => "Kick it old school this winter when you step out in the adidas Women's Tricot 3-Stripes Flare Pants. Ideal for post-gym wear, the stretchy tricot fabric allows you to move with ease as you recover from your big session.", 'featured' => 0, 'categoryId' => 3],
            ['itemId' => 10, 'brand' => 'Nike', 'itemName' => 'Nike Air Max 270', 'photo' => 'runningShoes.jpg', 'price' => 199.95, 'salePrice' => 169.95, 'description' => "Comfortable everyday running shoe with Nike's signature Air Max cushioning and breathable mesh upper.", 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 11, 'brand' => 'Adidas', 'itemName' => 'Adidas Predator Edge.3', 'photo' => 'football-boots.jpg', 'price' => 129.99, 'salePrice' => null, 'description' => 'Pro-level football boot with rubber strikezone for ultimate ball control and lockdown grip.', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 12, 'brand' => 'Asics', 'itemName' => 'Asics GT-2000', 'photo' => 'runningShoes.jpg', 'price' => 179.99, 'salePrice' => 139.99, 'description' => 'Stability running shoe with FlyteFoam technology for long-distance comfort and gentle support.', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 13, 'brand' => 'Nike', 'itemName' => 'Nike Mercurial Vapor', 'photo' => 'footyBoots.jpg', 'price' => 269.95, 'salePrice' => null, 'description' => 'Speed-focused football boot worn by elite players worldwide. Lightweight upper for explosive pace.', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 14, 'brand' => 'New Balance', 'itemName' => 'New Balance Fresh Foam', 'photo' => 'runningShoes.jpg', 'price' => 159.99, 'salePrice' => 129.99, 'description' => 'Plush Fresh Foam cushioning with breathable mesh upper for everyday training runs.', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 15, 'brand' => 'Adidas', 'itemName' => 'Adidas Copa Mundial', 'photo' => 'football-boots.jpg', 'price' => 189.95, 'salePrice' => null, 'description' => 'Iconic kangaroo leather football boot, a timeless classic that moulds to your foot.', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 16, 'brand' => 'Wilson', 'itemName' => 'Wilson Court Sneaker', 'photo' => 'runningShoes.jpg', 'price' => 99.95, 'salePrice' => null, 'description' => 'All-court tennis shoe with herringbone tread for excellent grip on hard courts.', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 17, 'brand' => 'Adidas', 'itemName' => 'Adidas Stan Smith', 'photo' => 'runningShoes.jpg', 'price' => 129.99, 'salePrice' => null, 'description' => 'Iconic minimalist tennis sneaker, perfect for casual wear and pre-game arrival.', 'featured' => 0, 'categoryId' => 1],
            ['itemId' => 18, 'brand' => 'Nike', 'itemName' => 'Nike Pro Running Shorts', 'photo' => 'tracksuit.jpg', 'price' => 44.99, 'salePrice' => null, 'description' => 'Lightweight running shorts with Dri-FIT moisture wicking technology and built-in compression liner.', 'featured' => 0, 'categoryId' => 3],
            ['itemId' => 19, 'brand' => 'Adidas', 'itemName' => 'Adidas Tiro Track Pants', 'photo' => 'tracksuit.jpg', 'price' => 69.95, 'salePrice' => 54.95, 'description' => 'Classic three-stripe track pants in soft polyester fabric. Ankle zips for easy on and off.', 'featured' => 0, 'categoryId' => 3],
            ['itemId' => 20, 'brand' => 'Asics', 'itemName' => 'Asics Cool Running Tee', 'photo' => 'blackTop.jpg', 'price' => 39.99, 'salePrice' => null, 'description' => 'Lightweight breathable tee with anti-odour technology for warm-weather training.', 'featured' => 0, 'categoryId' => 4],
            ['itemId' => 21, 'brand' => 'Nike', 'itemName' => 'Nike Dri-FIT Polo', 'photo' => 'whitePinkTop.jpg', 'price' => 54.99, 'salePrice' => 44.99, 'description' => 'Classic polo with Dri-FIT fabric for cool, dry comfort on and off the course.', 'featured' => 0, 'categoryId' => 4],
            ['itemId' => 22, 'brand' => 'Adidas', 'itemName' => 'Adidas Aeroready Hoodie', 'photo' => 'blackTop.jpg', 'price' => 79.95, 'salePrice' => null, 'description' => 'Soft moisture-wicking hoodie ideal for training warm-ups and post-workout recovery.', 'featured' => 0, 'categoryId' => 4],
            ['itemId' => 23, 'brand' => 'Wilson', 'itemName' => 'Wilson Evolution Basketball', 'photo' => 'soccerBall.jpg', 'price' => 89.99, 'salePrice' => 74.99, 'description' => 'Indoor basketball with composite leather cover for excellent grip and consistent bounce.', 'featured' => 0, 'categoryId' => 5],
            ['itemId' => 24, 'brand' => 'Adidas', 'itemName' => 'Adidas Tango Soccer Ball', 'photo' => 'soccerBall.jpg', 'price' => 54.99, 'salePrice' => null, 'description' => 'Match-quality soccer ball with butyl bladder for excellent air retention and flight.', 'featured' => 0, 'categoryId' => 5],
            ['itemId' => 25, 'brand' => 'Nike', 'itemName' => 'Nike Volley NUVO', 'photo' => 'soccerBall.jpg', 'price' => 39.95, 'salePrice' => null, 'description' => 'Beach volleyball with synthetic leather cover designed for outdoor play.', 'featured' => 0, 'categoryId' => 5],
            ['itemId' => 26, 'brand' => 'TriggerPoint', 'itemName' => 'TriggerPoint Foam Roller', 'photo' => 'waterBottle.jpg', 'price' => 59.95, 'salePrice' => null, 'description' => 'Self-massage foam roller for muscle recovery, mobility and pre-workout warm-up.', 'featured' => 0, 'categoryId' => 6],
            ['itemId' => 27, 'brand' => 'Adidas', 'itemName' => 'Adidas Resistance Bands Set', 'photo' => 'prod-image.jpg', 'price' => 34.99, 'salePrice' => 24.99, 'description' => 'Set of 5 colour-coded resistance bands for strength training and rehabilitation at home.', 'featured' => 0, 'categoryId' => 6],
            ['itemId' => 28, 'brand' => 'Manduka', 'itemName' => 'Manduka Yoga Mat', 'photo' => 'prod-image.jpg', 'price' => 89.95, 'salePrice' => null, 'description' => 'Premium non-slip yoga mat with 6mm cushioning for joint support and balance work.', 'featured' => 0, 'categoryId' => 6],
        ]);
    }
}
