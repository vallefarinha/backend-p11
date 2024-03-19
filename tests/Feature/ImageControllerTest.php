<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;

class ImageControllerTest extends TestCase
{
    public function testStoreImage()
    {
        // Cria um arquivo de imagem temporário
        $file = UploadedFile::fake()->image('test_image.jpg');

        // Mock do Cloudinary para simular o upload da imagem
        Cloudinary::shouldReceive('upload')->andReturn((object) ['secure_url' => 'https://picsum.photos/200/300']);

        // Cria uma instância de Request e atribui o arquivo de imagem a ela
        $request = Request::create('/admin/1/images', 'POST', ['image' => $file, 'product_id' => 1]);

        // Simula uma requisição passando a instância de Request
        $response = $this->app->handle($request);

        // Verifica se a resposta foi bem-sucedida (código 201)
        $response->assertStatus(201);

        // Verifica se a imagem foi criada no banco de dados
        $image = Image::where('image_url', 'https://picsum.photos/200/300')->first();
        $this->assertNotNull($image);
    }
}