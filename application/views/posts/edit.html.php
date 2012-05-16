<h2>Edit Post</h2>


<?= form_open('posts/update') ?>
  <input type="hidden" name="id" value="<?= $post->id ?>" />

  <div>
    <label>Title</label>
    <input type="text" name="title" value="<?= $post->title ?>" />
  </div>

  <div>  
    <label>Body</label>
    <textarea name="body"><?= $post->body ?></textarea>
  </div>
  
  <div>  
    <button type="submit">Save</button>
  </div>    

<?= form_close() ?>

<br /><br />

<p>
  <a href="/posts">Cancel</a>
</p>