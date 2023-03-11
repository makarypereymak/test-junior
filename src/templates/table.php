<nav>
  <ul class="tab-section">
    <?php if (isset($attemptCount) && !empty($attemptCount)) : ?>
      <?php $i = 1; ?>
      <?php while ($i <= $attemptCount) : ?>
        <li class="tab-section__item <?= $_GET["attempt"] === strval($i) ? "tab-section__item--active" : ""; ?>">
          <a href="index.php?attempt=<?= $i; ?>"><?= $i; ?>attempt</a>
          <?php $i++; ?>
        </li>
      <?php endwhile; ?>
    <?php endif; ?>
    <li class="tab-section__item <?= $_GET["attempt"] === "fullResult" ? "tab-section__item--active" : ""; ?>">
      <a href="index.php?attempt=fullResult">fullResult</a>
    </li>
  </ul>
</nav>
<table class="table">
  <tr class="table__row">
    <td class="table__cell">rank</td>
    <td class="table__cell">name</td>
    <td class="table__cell">city</td>
    <td class="table__cell">car</td>
    <?php if (isset($attemptCount) && !empty($attemptCount)) : ?>
      <?php $i = 1; ?>
      <?php while ($i <= $attemptCount) : ?>
        <td class="table__cell <?= $_GET["attempt"] === strval($i) ? "table__cell--active" : ""; ?>"><?= $i; ?>-result</td>
        <?php $i++; ?>
      <?php endwhile; ?>
    <?php endif; ?>
    <td class="table__cell <?= $_GET["attempt"] === "fullResult" ? "table__cell--active" : ""; ?>">full-result</td>
  </tr>
  <?php if (isset($fullInfo) && !empty($fullInfo)) : ?>
    <?php foreach ($fullInfo as $key => $value) : ?>
      <tr class="table__row">
        <td class="table__cell table__cell--number"><?= $key + 1; ?></td>
        <td class="table__cell table__cell--name"><?= $value["name"]; ?></td>
        <td class="table__cell table__cell--city"><?= $value["city"]; ?></td>
        <td class="table__cell table__cell--car"><?= $value["car"]; ?></td>
        <?php if (isset($attemptCount) && !empty($attemptCount)) : ?>
          <?php $i = 1; ?>
          <?php while ($i <= $attemptCount) : ?>
            <td class="table__cell <?= $_GET["attempt"] === strval($i) ? "table__cell--active" : ""; ?>"><?= $value[strval($i) . "-result"]; ?></td>
            <?php $i++; ?>
          <?php endwhile; ?>
        <?php endif; ?>
        <td class="table__cell <?= $_GET["attempt"] === "fullResult" ? "table__cell--active" : ""; ?>"><?= $value["fullResult"]; ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>