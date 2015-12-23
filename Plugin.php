<?php
if(!defined("__TYPECHO_ROOT_DIR__")) exit;
/**
* MoeCDN Plugin for Typecho by MoeNet
* 
* @package MoeCDN
* @author kirainmoe
* @version 1.0
* @link https://www,imim.pw/
*/
class MoeCDN_Plugin implements Typecho_Plugin_Interface
{
	/**
	 * 激活插件方法,如果激活失败,直接抛出异常。
	 * 
	 * @access public
	 * @return void
	 * @throws Typecho_Plugin_Exception
	 */
	public static function activate()
	{
		Typecho_Plugin::factory('Widget_Abstract_Comments')->gravatar = array('MoeCDN_Plugin', 'gravatar');
		Typecho_Plugin::factory('Widget_Archive')->beforeRender = array('MoeCDN_Plugin', 'googleApi_beforeRender');
	}

	/**
	* 禁用插件方法,如果禁用失败,直接抛出异常。然而对于本插件来说，并没有什么琴梨用。
	* 
	* @static
	* @access public
	* @return void
	* @throws Typecho_Plugin_Exception
	*/
	public static function deactivate(){}

	/**
	* 获取插件配置面板
	* 
	* @access public
	* @param Typecho_Widget_Helper_Form $form 配置面板
	* @return void
	*/
	public static function config(Typecho_Widget_Helper_Form $form)
	{
		$gravatar =  new Typecho_Widget_Helper_Form_Element_Radio('gravatar' , array('1'=>_t('开启'),'2'=>"开启，并使用 SSL 模式",'0'=>_t('关闭')),'1',_t('Gravatar 头像加速'),_t('会帮您把默认的 Gravatar 源替换到 MoeCDN Gravatar 源，如果需要 HTTPS 支持，请使用 SSL 模式。'));
		$form->addInput($gravatar);
		$gapi =  new Typecho_Widget_Helper_Form_Element_Radio('gapi' , array('1'=>_t('开启'),'0'=>_t('关闭')),'1',_t('Google API 加速'),_t('使用谷歌公共库可以加快网页加载速度，但是，众所周知的原因，在中国您不能享受这一点。然而现在，一切都不一样了。'));
		$form->addInput($gapi);		
	}

	/**
	* 个人用户的配置面板，对于本插件来说，还是没有什么卵用。
	* 
	* @access public
	* @param Typecho_Widget_Helper_Form $form
	* @return void
	*/
	public static function personalConfig(Typecho_Widget_Helper_Form $form){}

	public static function gravatar($size, $rating, $default, $widget){
		$gravatarOption = Typecho_Widget::widget('Widget_Options')->Plugin('MoeCDN')->gravatar;
		if($gravatarOption == 1) 
		    $url = 'http://gravatar.moefont.com/avatar/';
		elseif ($gravatarOption == 2 || $widget->request->isSecure())
			$url = 'https://gravatar-ssl.moefont.com/avatar/';
		if(!empty($widget->mail))
            $url .= md5(strtolower(trim($widget->mail)));
        $url .= '?s=' . $size;
        $url .= '&amp;r=' . $rating;
        $url .= '&amp;d=' . $default;
        echo '<img class="avatar" src="' . $url . '" alt="' .
                $widget->author . '" width="' . $size . '" height="' . $size . '" />';
	}

	public static function googleApi_beforeRender($archive){
		if(Typecho_Widget::widget('Widget_Options')->Plugin('MoeCDN')->gapi == 1)
			ob_start(array(__CLASS__, "moecdn_google_api_buffer"));
	}

	private static function moecdn_google_api_buffer($html){
		$html = str_replace("//fonts.googleapis.com",  "//cdn.moefont.com/fonts", $html);
		$html = str_replace("//ajax.googleapis.com",  "//cdn.moefont.com/ajax", $html);
		return $html;
	}
}


