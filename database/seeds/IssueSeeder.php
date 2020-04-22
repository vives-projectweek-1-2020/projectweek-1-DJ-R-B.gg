<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class IssueSeeder extends Seeder{

    public function run(){
        $int = rand(1262055681,1262055681);
        $string = date("Y-m-d H:i:s",$int);
        DB::table('issues')->insert([
            'name' => Str::random(10),
            'category'=> Str::random(10), 
            'issuecreate' => $string,
        ]);

    }

}