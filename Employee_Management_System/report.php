<?php
require 'config.php';
require_login();
$st = $pdo->query('SELECT e.*,d.department_name,p.position_title FROM employees e JOIN departments d ON d.department_id=e.department_id JOIN positions p ON p.position_id=e.position_id ORDER BY d.department_name,e.last_name');
$rows = $st->fetchAll(); ?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Employee Report</title>
    <style>
        body {
            font: 14px Arial, sans-serif;
            margin: 30px;
            color: #1b2b21;
            background: #fff
        }

        h1 {
            letter-spacing: .5px;
            color: #176638
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th,
        td {
            padding: 9px;
            border-bottom: 1px solid #dce8df;
            text-align: left
        }

        th {
            background: #eaf5ed;
            color: #245b35
        }

        @media print {
            button {
                display: none
            }
        }
    </style>
</head>

<body><button onclick="window.print()">Print / Save as PDF</button>
    <h1>CODER — EMPLOYEE REPORT</h1>
    <p>Generated <?= date('F d, Y h:i A') ?> · <?= count($rows) ?> records</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Hire date</th>
                <th>Status</th><?php if (is_admin()): ?>
                    <th>Salary</th><?php endif; ?>
            </tr>
        </thead>
        <tbody><?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= e($r['emp_no']) ?></td>
                    <td><?= e($r['first_name'] . ' ' . $r['last_name']) ?></td>
                    <td><?= e($r['department_name']) ?></td>
                    <td><?= e($r['position_title']) ?></td>
                    <td><?= e($r['hire_date']) ?></td>
                    <td><?= e($r['status']) ?></td><?php if (is_admin()): ?>
                        <td>₱<?= number_format($r['salary'], 2) ?></td><?php endif; ?>
                </tr><?php endforeach; ?>
        </tbody>
    </table>
    <p>Confidential — for authorized personnel only.</p>
</body>

</html>