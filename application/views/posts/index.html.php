<h2>Posts</h2>

<ul>
  <?php foreach ( $posts as $post ) : ?>
    <li>
      <a href="/posts/<?= $post->id ?>"><?= $post->title ?></a>
    </li>
  <?php endforeach; ?>
</ul>

<p>
  <a href="/posts/new">Create New Post</a>
</p>