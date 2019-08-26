<?php
 if(! empty($message)) {
?>
    <div class="alert alert-<?php echo array_key_exists('success', $message) ? 'success' : 'warning'; ?>">
      <?php echo $message['success'] ?? $message['warning'] ?>
    </div>
<?php
 } 
?>