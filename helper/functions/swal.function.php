<?php
namespace app\helper\functions;

?>
<?php function swal($title, $icon = 'success', $text = '') { ?>

  <script>

    swal({
      icon: '<?php echo $icon; ?>',
      title: '<?php echo $title; ?>',
      text: '<?php echo $text; ?>',
      buttons: { success: { text: 'Okay!', value: 'reload' } }
    }).then((value) => {
      if (value == 'reload') {
        window.location.reload();
      }
    });

  </script>

<?php } ?>



<?php function defSwal($title, $icon = 'success', $text = '') { ?>

  <script>

    swal({
      icon: '<?php echo $icon; ?>',
      title: '<?php echo $title; ?>',
      text: '<?php echo $text; ?>',
    });

  </script>

<?php } ?>
