<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB; 

class Slug {


    public static function slug_category($title, $bagian, $id) 
    {
    	$slug = str_slug($title);
    	$allSlugs = DB::table('kategori')->where('slug', 'like', $slug.'%')
	        	->where('bagian', '=', $bagian)
	            ->where('id', '<>', $id)
	            ->get();
        
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        for ($i = 1; ; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    public static function slug_barang($title, $id, $id_kategori) 
    {
    	$slug = str_slug($title);
    	$allSlugs = DB::table('barang')
    			->where('slug', 'like', $slug.'%')
    			->where('id_kategori', '=', $id_kategori)
	            ->where('id', '<>', $id)
	            ->get();
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        for ($i = 1; ; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }
}