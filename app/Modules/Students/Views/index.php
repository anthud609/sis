<h1 class="text-2xl font-bold text-gray-800 mb-6">All Students</h1>

<div class="bg-white shadow rounded-lg overflow-hidden">
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-100">
      <?php foreach ($students as $index => $student): ?>
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            <?= htmlspecialchars($student['name']) ?>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <?= htmlspecialchars($student['email']) ?>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <?= htmlspecialchars($student['project']) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
