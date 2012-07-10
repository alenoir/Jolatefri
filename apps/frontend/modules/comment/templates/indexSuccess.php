<h1>Comments List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Fb</th>
      <th>Username</th>
      <th>Message</th>
      <th>Video</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($comments as $comment): ?>
    <tr>
      <td><a href="<?php echo url_for('comment/edit?id='.$comment->getId()) ?>"><?php echo $comment->getId() ?></a></td>
      <td><?php echo $comment->getFbId() ?></td>
      <td><?php echo $comment->getUsername() ?></td>
      <td><?php echo $comment->getMessage() ?></td>
      <td><?php echo $comment->getVideoId() ?></td>
      <td><?php echo $comment->getCreatedAt() ?></td>
      <td><?php echo $comment->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('comment/new') ?>">New</a>
