<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<!-- Заголовок таблицы -->
<table class="table">
  <thead class="table table-striped table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">City</th>
      <th scope="col">Phone</th>
      <th scope="col">Company</th>
      <th scope="col">Email</th>
    </tr>
  </thead>

<!-- Вывод строк таблицы в цикле  -->
  <tbody>
  	<?php for ($i=0; $i < $view->quantity ; $i++) : ?>
	<?php if($view->buyers[$i]) : ?>
    <tr>
      <th scope="row"><?= $view->buyers[$i]['id']?></th>
      <td><?= $view->buyers[$i]['name']?></td>
      <td><?= $view->buyers[$i]['city']?></td>
      <td><?= $view->buyers[$i]['phone_number']?></td>
      <td><?= $view->buyers[$i]['conpany']?></td>
      <td><?= $view->buyers[$i]['email']?></td>
    </tr>
  </tbody>
<?php endif; ?>
<?php endfor; ?>
</table>

<!-- Вывод ссылок пагинации в цикле  -->
<nav aria-label="...">
  <ul class="pagination">
<?php for ($i=1; $i <= count($view->pagination_view()); $i++) : ?>
  
 <!-- Тернарное выражение для подсвечивание актуального  номера страницы -->
    <li class="page-item <?=($i==$view->page) ? 'active' : ''; ?> ">
     <?= '<a class="page-link" href="'.$view->pagination_view()[$i].'">'.$i.'</a>' ?>
    </li>

 <?php endfor; ?> 
<!--  Кнопки для фильтрации  -->
 <a href="?filter=ASC">ASC</a>||<a href="?filter=DESC">DESC</a>
  </ul> 
</nav>


