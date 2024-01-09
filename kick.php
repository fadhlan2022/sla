<?php
$title = 'kick';
include 'requirement.php';
?>

<!--
`body` tag options:

  Apply one or more of the following classes to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<script type="text/javascript">
  setTimeout(function() {
    alert("You do not have access. Redirecting to logout...");
    window.location.replace('logout.php');
  }, 500);  // 3 seconds cooldown
</script>

</body>
</html>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php
include 'script.php';
?>
</body>
</html>
