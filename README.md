# MoeCDN-Typecho

MoeCDN Plugin for Typecho 0.9 or later version ( MoeNet.Inc )

-----

插件和MoeCDN的建设暂时处于开始阶段，因此我们很抱歉无法提供很多的功能。
目前由 MoeCDN-Wordpress 移植到 MoeCDN-Typecho 的功能有：

### 免费 Gravatar 头像加速

因为众所周知的原因，在天朝是无法显示 Gravatar 头像的哦~啊，那怎么办呢？也是有办法的~！

<s>将 gravatar.com 的原有域名，直接指向 gravatar.moefont.com 即可 如果需要 HTTPS 支持，请使用 gravatar-ssl.moefont.com ，* 非 HTTPS 站点请勿使用 *。</s>

然而，如果你在 Typecho 上使用这个插件，只需勾选一个 radio 就可以啦~

### 免费 GoogleApis 加速

使用谷歌公共库可以加快网页加载速度，但是，众所周知的原因，在中国您不能享受这一点

但是现在，您只需替换googleapis.com为cdn.moefont.com即可享受这一切~

例如：

fonts.googleapis.com -> cdn.moefont.com/fonts

ajax.googleapis.com -> cdn.moefont.com/ajax

这个复杂的工作也让 MoeCDN-Typecho 帮你完成吧~

## 现在就去下载吧~

点击上面的 Download-Zip，然后解压并修改解压出来的文件夹名字为“MoeCDN”，上传到 Your Typecho/usr/plugins/ 目录下，到后台启用插件即可。

## 关于启用插件提示 500 的说明

 1. 发生此原因的时候，百分之九十九的情况下删除插件文件夹 ./usr/plugins/MoeCDN-Typecho-master 文件名中的 "-Typecho-master"，仅保留“MoeCDN”或其他名字即可。
 2. 如果无法解决问题，请在 config.inc.php 中 加入 ```define("__TYPECHO_DEBUG__",true);``` ，然后复制错误信息到 GitHub issues 页面提问。

## 其他

MoeCDN for Typecho 插件的诞生离不开 [@MoeNetwork](https://github.com/MoeNetwork) 对 MoeCDN 项目的建设以及 [@kokororin](https://github.com/kokororin) 对插件代码的修改优化
