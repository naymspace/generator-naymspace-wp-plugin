<?php namespace <%namespace%>; ?>

<div class="wrap">
  <h2>Optionen</h2>

  <form method="post" action="">
    <table class="form-table">
      <tbody>
        <?php foreach(Base::$options as $option): // display options defined in plugins index.php ?>
          <tr valign='top'>
            <?php Backend::render_option($option); ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <p class="submit">
      <input type="submit" class="button-primary" value="Speichern" />
    </p>
  </form>
</div>

