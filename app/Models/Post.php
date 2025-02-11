<?php 

namespace App\Models;

use Illuminate\Support\Arr;

  class Post
  {
      public static function all()
      {
          return [
              [
                  'id' => 1,
                  'slug' => 'judul-artikel-1',
                  'title' => 'Judul Artikel 1',
                  'author' => 'Adhim Tanfitra',
                  'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, esse. Ipsam voluptatibus dolorum in similique! Hic temporibus optio animi officia harum tenetur nobis reprehenderit reiciendis incidunt quidem dolorum, placeat molestiae!'
              ],
              [
                  'id' => 2,
                  'slug' => 'judul-artikel-2',
                  'title' => 'Judul Artikel 2',
                  'author' => 'Adhim Tanfitra',
                  'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi velit alias unde culpa eius? Cumque id obcaecati nam magnam quos. Laborum dicta minus iste, doloribus quas reprehenderit animi doloremque. In.'
              ]
          ];
      }
      
      public static function find($slug)
      {
          $post = Arr::first(static::all(), fn ($post) => $post['slug'] == $slug);

          if (!$post) {
              abort(404);
          }

          return $post;
      }
  }

