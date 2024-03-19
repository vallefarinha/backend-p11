<?php

namespace App\Http\Controllers;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use App\Models\Image;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_id' => 'required|exists:products,id'
        ]);

        // Faz o upload da imagem para o Cloudinary
        $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath());

        // Obtém a URL da imagem do Cloudinary
        $imageUrl = $uploadedFile->secure_url; // Corrigindo para acessar a URL segura

        // Cria uma nova instância do modelo Image e armazena no banco de dados
        $image = Image::create([
            'image_url' => $imageUrl,
            'product_id' => $request->product_id
        ]);

        return response()->json($image, 201);
    }

}