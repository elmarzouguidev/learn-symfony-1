<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{


    #[Route('/recipes', name: 'recipe.index')]

    public function index(Request $request, RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findWithDurationLowerThan(20);

        //dd($recipes);

        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
            'recipes' => $recipes
        ]);
    }

    #[Route('/recipes/{slug}-{id}', name: 'recipe.show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+'])]

    public function show(Request $request, string $slug, int $id,RecipeRepository $recipeRepository): Response
    {

        //$recipe = $recipeRepository->find($id);
        $recipe = $recipeRepository->findOneBy(['slug'=>$slug]);
        //dd($recipe);
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
