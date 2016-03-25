<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 05.03.2016
 * Time: 21:33
 */

namespace App\Modules\SelmarinelCore\Http\Controllers;

use App\Modules\SelmarinelCore\Database\Models\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SiteController extends Controller
{
    protected $serviceName = 'App\Modules\SelmarinelCore\Http\Services\Projects';

    protected function index(){
        $this->service->setWhere(['status'=>Base::STATUS_ACTIVE]);
        return view($this->getViewRoute(), ['collection' => $this->service->getAll(8)
            ->sortByDesc(function ($item) {
            return $item->created_at    ;
        })]);
    }

    public function all(){
        $this->service->setWhere(['status'=>Base::STATUS_ACTIVE]);
        if (($this->service->getAll(1)->first()->id)) {
            $api = new APIController();
            $api->increment($this->service->getAll(1)->first()->id);
        }
        return view($this->getViewRoute('page'), ['collection' => $this->service->getAll(1)]);
    }


    protected $client_id = '5168429'; // ID приложения
    protected $client_secret = 'LGk6DbSMigKjv1rzIImA'; // Защищённый ключ
    protected $redirect_uri = 'http://core.loc/site/api/vk_auth'; // Адрес сайта
    protected $url = 'http://oauth.vk.com/authorize';
    protected $user;

    public function redirectToProvider()
    {
        $params = array(
            'client_id'     => $this->client_id,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => 'code'
        );
        return redirect($this->url . '?' . urldecode(http_build_query($params)));
    }

    private function fileGetContents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public function handleProviderCallback()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'code' => $_GET['code'],
                'redirect_uri' => $this->redirect_uri
            );
            $token = json_decode($this->fileGetContents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
            if (isset($token['access_token'])) {
                $params = array(
                    'uids' => $token['user_id'],
                    'fields' => 'uid,first_name,last_name,screen_name,photo_100',
                    'access_token' => $token['access_token']
                );
                $this->user = json_decode($this->fileGetContents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

                if (isset( $this->user['response'][0]['uid'])) {
                    $this->user =  $this->user['response'][0];
                    return redirect(route('site:index'))
                        ->withCookie(Cookie::make('name',$this->user['first_name'],60))
                        ->withCookie(Cookie::make('img',$this->user['photo_100'],60));
                }
            }
        }
        return redirect(route('site:index'))
            ->withCookie(Cookie::make('name',null))
            ->withCookie(Cookie::make('name',null));
    }

}