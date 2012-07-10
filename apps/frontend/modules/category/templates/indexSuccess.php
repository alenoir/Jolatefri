<h1>Categorys List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categorys as $category): ?>
    <tr>
      <td><a href="<?php echo url_for('category/edit?id='.$category->getId()) ?>"><?php echo $category->getId() ?></a></td>
      <td><?php echo $category->getName() ?></td>
      <td><?php echo $category->getCreatedAt() ?></td>
      <td><?php echo $category->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('category/new') ?>">New</a>
