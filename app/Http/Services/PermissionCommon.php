<?php namespace Custom\Services;
use Illuminate\Support\Facades\Auth;

class PermissionCommon {

    private $currentUser;

    public function __construct(Auth $auth){
        $this->currentUser = Auth::user();
    }

    const ADMIN = 1;
    const WEBMASTER = 2;
    const TELE_SALE = 3;
    const EDITOR = 4;
    const SEO = 5;
    const CHO_VAY = 6;
	const VAY = 7;

    /*
    | -------------------------------------------------
    | GET ROLE NAME BY NUMBER ENUM
    | -------------------------------------------------
    | @params enum $id
    | @author : tantan
    */
    public static function getRoleName($id) : string{
        if( $id == self::ADMIN ) return 'admin';
        if( $id == self::WEBMASTER ) return 'webmaster';
        if( $id == self::TELE_SALE ) return 'tele sale';
        if( $id == self::EDITOR ) return 'editor';
        if( $id == self::SEO ) return 'seo';
        if( $id == self::CHO_VAY ) return 'nhà đầu tư';
        if( $id == self::VAY ) return 'người vay';
        return null;
    }

}