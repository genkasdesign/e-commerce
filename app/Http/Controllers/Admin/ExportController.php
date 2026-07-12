<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    // Export des commandes avec détails (une ligne par produit)
    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])->get();

        $csvData = [];
        // En-têtes
        $headers = [
            'ID Commande',
            'Client',
            'Email',
            'Total (€)',
            'Statut',
            'Date',
            'Produit',
            'Quantité',
            'Prix unitaire (€)',
            'Sous-total (€)'
        ];
        $csvData[] = $headers;

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $csvData[] = [
                    $order->id,
                    $order->user->name ?? 'Client supprimé',
                    $order->user->email ?? 'email@inconnu',
                    number_format($order->total, 2, '.', ''),
                    $order->status,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $item->product->name ?? 'Produit supprimé',
                    $item->quantity,
                    number_format($item->price, 2, '.', ''),
                    number_format($item->quantity * $item->price, 2, '.', ''),
                ];
            }
        }

        return $this->downloadCsv($csvData, 'commandes_detaillees.csv');
    }

    // Export des clients
    public function clients()
    {
        $clients = User::where('is_admin', false)->get();

        $csvData = [];
        $headers = ['ID', 'Nom', 'Email', 'Inscrit le', 'Admin'];
        $csvData[] = $headers;

        foreach ($clients as $client) {
            $csvData[] = [
                $client->id,
                $client->name,
                $client->email,
                $client->created_at->format('Y-m-d H:i:s'),
                $client->is_admin ? 'Oui' : 'Non',
            ];
        }

        return $this->downloadCsv($csvData, 'clients.csv');
    }

    // Méthode privée pour générer et télécharger le CSV
    private function downloadCsv(array $data, string $filename)
    {
        $callback = function() use ($data) {
            $handle = fopen('php://output', 'w');
            // Ajout du BOM pour UTF-8 (compatible Excel)
            fputs($handle, "\xEF\xBB\xBF");
            foreach ($data as $row) {
                fputcsv($handle, $row, ';');
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}