<?php

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert(['name' => 'EPS', 'type' => 'isolatie', 'value' => 0.036]);
        DB::table('materials')->insert(['name' => 'GEEN','type' => 'isolatie', 'value' => 1000]);
        DB::table('materials')->insert(['name' => 'PIR','type' => 'isolatie', 'value' => 0.022]);
        DB::table('materials')->insert(['name' => 'PUR','type' => 'isolatie', 'value' => 0.025]);
        DB::table('materials')->insert(['name' => 'RESOL','type' => 'isolatie', 'value' => 0.02]);
        DB::table('materials')->insert(['name' => 'VAC','type' => 'isolatie', 'value' => 0.007]);
        DB::table('materials')->insert(['name' => 'WOL','type' => 'isolatie', 'value' => 0.034]);
        DB::table('materials')->insert(['name' => 'XPS','type' => 'isolatie', 'value' => 0.034]);

        DB::table('materials')->insert(['name' => 'Enkel Glas','type' => 'glas', 'value' => 0.172]);
        DB::table('materials')->insert(['name' => 'Gelaagd Glas','type' => 'glas', 'value' => 0.300]);
        DB::table('materials')->insert(['name' => 'HR Glas','type' => 'glas', 'value' => 0.500]);
        DB::table('materials')->insert(['name' => 'HR+ Glas','type' => 'glas', 'value' => 0.625]);
        DB::table('materials')->insert(['name' => 'HR++ Glas','type' => 'glas', 'value' => 0.909]);
        DB::table('materials')->insert(['name' => 'HR+++ Glas','type' => 'glas', 'value' => 1.667]);
        DB::table('materials')->insert(['name' => 'Isolatieglas','type' => 'glas', 'value' => 0.333]);
        DB::table('materials')->insert(['name' => 'Kwaliteit HR Glas','type' => 'glas', 'value' => 0.588]);
        DB::table('materials')->insert(['name' => 'Kwaliteit HR+ Glas','type' => 'glas', 'value' => 0.769]);
        DB::table('materials')->insert(['name' => 'Kwaliteit HR++ Glas','type' => 'glas', 'value' => 1.111]);
        DB::table('materials')->insert(['name' => 'Standaard Dubbel Glas','type' => 'glas', 'value' => 0.357]);
        DB::table('materials')->insert(['name' => 'Super HR+++ Glas','type' => 'glas', 'value' => 2.500]);

        DB::table('materials')->insert(['name' => 'Aluminium', 'type' => 'bouwmateriaal', 'value' => 220.00]);
        DB::table('materials')->insert(['name' => 'Fermacell', 'type' => 'bouwmateriaal', 'value' => 0.03]);
        DB::table('materials')->insert(['name' => 'Gipsplaat', 'type' => 'bouwmateriaal', 'value' => 0.40]);
        DB::table('materials')->insert(['name' => 'Hout Hardboard', 'type' => 'bouwmateriaal', 'value' => 0.35]);
        DB::table('materials')->insert(['name' => 'Hout Naaldhout', 'type' => 'bouwmateriaal', 'value' => 0.17]);
        DB::table('materials')->insert(['name' => 'Hout OSB plaat', 'type' => 'bouwmateriaal', 'value' => 0.13]);
        DB::table('materials')->insert(['name' => 'Hout Spaanplaat', 'type' => 'bouwmateriaal', 'value' => 0.25]);
        DB::table('materials')->insert(['name' => 'Hout Tri- en Multiplex', 'type' => 'bouwmateriaal', 'value' => 0.16]);
        DB::table('materials')->insert(['name' => 'Plavuizen', 'type' => 'bouwmateriaal', 'value' => 1.04]);
        DB::table('materials')->insert(['name' => 'Plexiglas', 'type' => 'bouwmateriaal', 'value' => 0.20]);
        DB::table('materials')->insert(['name' => 'Staal', 'type' => 'bouwmateriaal', 'value' => 50.00]);
        DB::table('materials')->insert(['name' => 'Staal puddleijzer', 'type' => 'bouwmateriaal', 'value' => 72.00]);
        DB::table('materials')->insert(['name' => 'Staal RVS', 'type' => 'bouwmateriaal', 'value' => 15.00]);
        DB::table('materials')->insert(['name' => 'Tegels', 'type' => 'bouwmateriaal', 'value' => 1.5]);

        DB::table('materials')->insert(['name' => 'Luchtspouw wand 0.5 cm', 'type' => 'Luchtspouw', 'value' => 0.11]);
        DB::table('materials')->insert(['name' => 'Luchtspouw wand 1.0 cm', 'type' => 'Luchtspouw', 'value' => 0.18]);
        DB::table('materials')->insert(['name' => 'Luchtspouw wand 2.5 cm', 'type' => 'Luchtspouw', 'value' => 0.16]);
        DB::table('materials')->insert(['name' => 'Luchtspouw wand 5.0 cm', 'type' => 'Luchtspouw', 'value' => 0.15]);
        DB::table('materials')->insert(['name' => 'Luchtspouw plafond 0.5 cm', 'type' => 'Luchtspouw', 'value' => 0.15]);
        DB::table('materials')->insert(['name' => 'Luchtspouw plafond 1.0 cm', 'type' => 'Luchtspouw', 'value' => 0.11]);
        DB::table('materials')->insert(['name' => 'Luchtspouw plafond 2.5 cm', 'type' => 'Luchtspouw', 'value' => 0.16]);
        DB::table('materials')->insert(['name' => 'Luchtspouw plafond 5.0 cm', 'type' => 'Luchtspouw', 'value' => 0.19]);
        DB::table('materials')->insert(['name' => 'Luchtspouw vloer 0.5 cm', 'type' => 'Luchtspouw', 'value' => 0.18]);
        DB::table('materials')->insert(['name' => 'Luchtspouw vloer 1.0 cm', 'type' => 'Luchtspouw', 'value' => 0.15]);
        DB::table('materials')->insert(['name' => 'Luchtspouw vloer 2.5 cm', 'type' => 'Luchtspouw', 'value' => 0.11]);
        DB::table('materials')->insert(['name' => 'Luchtspouw vloer 5.0 cm', 'type' => 'Luchtspouw', 'value' => 0.21]);
    }
}
