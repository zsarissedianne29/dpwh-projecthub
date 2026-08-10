use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('projects', 'revised_contract_amount')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->decimal('revised_contract_amount', 15, 2)
                      ->nullable()
                      ->after('contract_amount');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('projects', 'revised_contract_amount')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('revised_contract_amount');
            });
        }
    }
};