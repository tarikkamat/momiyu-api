<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Momiyu API Documentation",
 *      description="Momiyu API Documentation",
 *      @OA\Contact(
 *          email="api@momiyu.com.tr"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * @OA\OpenApi(
 *      @OA\Server(url="http://localhost:8000/api/v1"),
 *      @OA\ExternalDocumentation(
 *          description="Find out more about Momiyu",
 *          url="https://api.momiyu.com.tr/api/v1/docs"
 *      )
 * )
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 * @OA\Tag(
 *      name="Users",
 *      description="API Endpoints for User Operations"
 * )
 */
class SwaggerController extends Controller
{

}
