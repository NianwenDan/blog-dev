<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 实用的图片增强工具
 *
 * @package imgPlugin
 * @author 
 * @version 1.0.0
 * @link 
 */
class imgPlugin_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate(){
      Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('imgPlugin_Plugin','feature');
      Typecho_Plugin::factory('Widget_Archive')->header = array('imgPlugin_Plugin','header');
      Typecho_Plugin::factory('Widget_Archive')->footer = array('imgPlugin_Plugin','footer');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){
      $enableSwipBox =  new Typecho_Widget_Helper_Form_Element_Radio(
        'enableSwipBox', array('1' => _t('开启'), '0' => _t('关闭')), '1', _t('开启FancyBox灯箱'));
		  $form->addInput($enableSwipBox);

      $enableLazyLoading =  new Typecho_Widget_Helper_Form_Element_Radio(
        'enableLazyLoading', array('1' => _t('开启'), '0' => _t('关闭')), '0', _t('开启图片懒加载'), _t('会给所有img标签加上loading="lazy"的标签'));
		  $form->addInput($enableLazyLoading);

      $enableDGToken =  new Typecho_Widget_Helper_Form_Element_Radio(
        'enableDGToken', array('1' => _t('开启'), '0' => _t('关闭')), '0', _t('开启多吉云CDN图片鉴权'));
      $form->addInput($enableDGToken);

      $dogeCloudURL = new Typecho_Widget_Helper_Form_Element_Text('dogeCloudURL', NULL, null, _t('鉴权URL'), _t('需要鉴权的URL, 例如https://example.com'));
		  $form->addInput($dogeCloudURL);

      $dogeCloudToken = new Typecho_Widget_Helper_Form_Element_Text('dogeCloudToken', NULL, null, _t('多吉云Token'), _t('填写多吉云官网中的Token'));
      $form->addInput($dogeCloudToken);

      $dogeCloudRand = new Typecho_Widget_Helper_Form_Element_Text('dogeCloudRand', NULL, null, _t('多吉云随机数'), _t('这可以是一个任意的随机数'));
      $form->addInput($dogeCloudRand);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件实现方法
     *
     * @access public
     * @param Widget_Archive $archive
     * @return void
     */
	public static function feature($content,$widget,$lastResult)
	{
    $options = Typecho_Widget::widget('Widget_Options')->Plugin('imgPlugin');

    // DogeCloud Token Feature
    if ($options->enableDGToken == '1') {
      $secretKey = $options->dogeCloudToken;
      $domain = $options->dogeCloudURL;
      // Modify the regular expression to match img tags
      $pattern = '/<img src="' . preg_quote($domain, '/') . '([^"]*)" alt="([^"]*)" title="([^"]*)">/i';
#      echo('<!--  '.$content.' -->');
      $content = preg_replace_callback(
        $pattern,
        function ($matches) use ($secretKey, $domain) {
          $path = $matches[1]; // This is the URL path
          $authKey = self::generateAuthKey($path, $secretKey);
          return '<img src="' . $domain . $path . '?auth_key=' . $authKey . '" alt="' . $matches[2] . '" title="' . $matches[3] . '">';
       },
      
      $content
    );
      #$content = preg_replace("/<img src=\"([^\"]*)\" alt=\"([^\"]*)\" title=\"([^\"]*)\">/i", '<img src="$1?auth_key=test" alt="$2" title="$3">', $content);
    }

    // SwipBox Feature
    if ($options->enableSwipBox == '1') {
      $content = preg_replace("/<img src=\"([^\"]*)\" alt=\"([^\"]*)\" title=\"([^\"]*)\">/i", "<a href=\"\\1\" title=\"\\3\" data-fancybox=\"gallery\" data-caption=\"\\3\"><img src=\"\\1\" alt=\"\\2\" title=\"\\3\"></a>", $content);
    }

    // Lazy Loading Feature
    if ($options->enableLazyLoading == '1') {
      $content = preg_replace(
        "/<img (.*?)>/i", 
        "<img \$1 loading=\"lazy\">", 
        $content
      );
    }

		return $content;
	}

  /**
   * 计算多吉云AuthKey
   */
  private static function generateAuthKey($path, $key) {
    $options = Typecho_Widget::widget('Widget_Options')->Plugin('imgPlugin');
    $rand = $options->dogeCloudRand; // Random Value
    date_default_timezone_set("UTC");
    $timestamp = strtotime(date('Y-m-d 00:00:00'));
    // $expirationTimestamp = $timestamp + 259200; // expire 3 days after utc time
    $expirationTimestamp = $timestamp + 86400 ; // expire 1 days after utc time

    // Get User ID if login
    $user = Typecho_Widget::widget('Widget_User');
    $uid = $user->hasLogin() ? $user->uid : 0;

    // Combine the components into a string
    $dataToHash = $path . '-' . $expirationTimestamp . '-' . $rand . '-' . $uid . '-' . $key;

    // Calculate the MD5 hash of the combined data
    $md5hash = md5($dataToHash);

    // Combine all the components to form the final auth_key
    $authKey = $expirationTimestamp . '-' . $rand . '-' . $uid . '-' . $md5hash;

    return $authKey;
  }

	/**
	 * 头部css挂载
	 * 
     * @access public
	 * @return void
	 */
  public static function header() {
	  echo '<link href="'.Helper::options()->pluginUrl.'/imgPlugin/css/fancybox@4.0.31.css" rel="stylesheet">';
  }
	/**
	 * 尾部js挂载
	 *
   * @access public
	 * @return void
	 */
  public static function footer() {
	  echo '<script src="' . Helper::options()->pluginUrl . '/imgPlugin/js/fancybox@4.0.31.umd.js"></script>';
	}
}
