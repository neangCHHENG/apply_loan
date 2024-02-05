<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helper\RBAC;
use Illuminate\Support\Facades\Route;
use App\Models\CategoryArticle;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class ArticleController extends Controller
{
    protected function dataList()
    {
        return Article::where('state', 1)->with('category')->get();
    }

    public function view()
    {

        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return View('AdminMenu.Article.index');
    }

    public function index()
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            // $dataLidst = Type::where('status', 1)->get();
            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Menu Index Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function create()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return View('AdminMenu.Article.form')
            ->with('Article', null)
            ->with('category', CategoryArticle::where('state', 1)->get())
            ->with('RelateArticle', $this->dataList());
    }

    public function store(Request $request)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            $validation = Validator($request->all(), [
                'title_en' => 'required',
                'title_kh' => 'required',
                // 'slug_kh' => 'required|unique:articles',
                // 'slug_en' => 'required|unique:articles',
                'feature' => 'required',
                'access' => 'required',
                'parent_category_id' => 'required',
                'article_editor_en' => 'required',
                'article_editor_kh' => 'required',
                'ordering' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'icon' => 'error',
                        'result' => $validation->getMessageBag()
                    ]
                );
            }
            $data = $request->all();

            $slugOld = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->title_en));
            $oldName = Article::where('slug_en',  $slugOld)->first();
            $code = random_int(100000, 999999);
            if ($oldName == null) {
                $oldID = '';
            } else {
                $oldID = '-' . $code;
            }

            $data['slug_en'] = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->title_en . $oldID));
            $data['slug_kh'] = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->title_kh . $oldID));

            Article::create($data);

            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );

            // Create the article record
            $article = Article::create($data);

            // Share the article to Facebook Page
            try {
                $fb = new Facebook([
                    'app_id' => '1375226320010337', // Replace with your Facebook App ID
                    'app_secret' => '8e63b78065216114536fea0b403a2fed', // Replace with your Facebook App Secret
                    'default_graph_version' => 'v12.0', // Replace with desired API version
                ]);

                $pageAccessToken = 'YOUR_PAGE_ACCESS_TOKEN'; // Replace with your page access token
                $articleUrl = route('articles.show', ['slug' => $article->slug_en]); // Replace with your article URL

                $response = $fb->post(
                    "/YOUR_PAGE_ID/feed",
                    [
                        'message' => 'New article published: ' . $article->title_en,
                        'link' => $articleUrl,
                    ],
                    $pageAccessToken
                );

                // Handle success or error response here
                $facebookResponse = $response->getDecodedBody();

                // Your response handling logic...

            } catch (FacebookResponseException $e) {
                // Handle Facebook API response errors
            } catch (FacebookSDKException $e) {
                // Handle SDK errors
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Insert data Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    // show => ediit
    public function show(Article $Article)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            return View('AdminMenu.Article.form')
                ->with('Article',  $Article)
                ->with('category', CategoryArticle::where('state', 1)->get())
                ->with('RelateArticle', $this->dataList());

            return [
                'status' => 'success',
                'icon' => 'success',
                'data' => $Article,
                'view' => View('AdminMenu.Article.form')
            ];
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Update data Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function update(Request $request, Article $Article)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }

            $validation = Validator($request->all(), [
                'title_en' =>   'required',
                'title_kh' =>   'required',
                // 'slug_kh' => 'required|unique:articles,slug_kh,' . $Article->id,
                // 'slug_en' => 'required|unique:articles,slug_en,' . $Article->id,
                'feature' => 'required',
                'access' => 'required',
                'parent_category_id' => 'required',
                'article_editor_en' => 'required',
                'article_editor_kh' => 'required',
                'ordering' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'icon' => 'error',
                        'result' => $validation->getMessageBag()
                    ]
                );
            }
            $data = $request->all();

            // $slugOld = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->title_en));
            // $oldName = Article::where('slug_en',  $slugOld)->first();

            // $code = random_int(100000, 999999);
            // if($oldName != null && $Article->slug_en != $request->slug_en){
            //     $oldID = '-' . $code;
            //     $data['slug_en'] = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->title_en . $oldID));
            //     $data['slug_kh'] = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\ \  \|\\\]/", "-", strtolower($request->title_kh . $oldID));
            // }

            $data['slug_en'] = $Article->slug_en;
            $data['slug_kh'] = $Article->slug_kh;
            $Article->update($data);

            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Update data Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function destroy(Article $Article)
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            $Article['state'] = 0;
            $Article->update();


            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Delete Data Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }
}
