<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Padres Public
 * @since Padres Public 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">

    <img src="<?php bloginfo('template_url'); ?>/images/banner_gwynn_and_coleman.jpg" alt="Tony Gwynn and Jerry Coleman tribute" width="745px" height="140px" class="jerry"/>

    <div class="footer-inner">
      <a href="privacy-policy">Privacy Policy</a>

      <div class="click"></div>

      <div class="box"></div> <!-- sorry semantic jerks! -->
    </div>

	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<!-- add google analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  var pluginUrl =
  '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
  _gaq.push(['_require', 'inpage_linkid', pluginUrl]);
  _gaq.push(['_setAccount', 'UA-38182880-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php wp_footer(); ?>

<!-- disabling the toolbar since it breaks the mobile layout
<script src="http://www.yardbarker.com/network.js" type="text/javascript"></script><script defer="false" type="text/javascript">_siteid = 11638; yardbar(); </script>
-- >

<script src="http://network.yardbarker.com/network/ybn_pixel/11638" type="text/javascript"></script> <noscript></noscript>

</body>
</html>