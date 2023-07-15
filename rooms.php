<?php
include 'layout/user/header_user.php';
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Rooms</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Rooms</li>
      </ol>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          DataTable Example
        </div>
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
              </tr>
            </tfoot>
            <tbody>
              <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <?php
  include 'layout/user/footer_user.php';
  ?>