
<x-app-layout>
    <div class="p-6 lg:p-8 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Riwayat Aktivitas
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Catatan aktivitas login dan logout pengguna SIAKAD.
            </p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
            <form method="GET"
                  action="{{ route('admin.activity-log.index') }}"
                  class="flex flex-col md:flex-row gap-3">

                <div class="flex-1">
                    <label for="search"
                           class="block text-sm font-medium text-gray-700 mb-1">
                        Pencarian
                    </label>
                    <input
                        id="search"
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama, email, atau alamat IP..."
                        class="w-full rounded-lg border-gray-300 text-sm
                               focus:border-blue-500 focus:ring-blue-500"
                    >
                </div>

                <div class="w-full md:w-48">
                    <label for="action"
                           class="block text-sm font-medium text-gray-700 mb-1">
                        Jenis aktivitas
                    </label>
                    <select
                        id="action"
                        name="action"
                        class="w-full rounded-lg border-gray-300 text-sm
                               focus:border-blue-500 focus:ring-blue-500"
                    >
                        <option value="">Semua aktivitas</option>
                        <option value="login"
                            @selected(request('action') === 'login')>
                            Login
                        </option>
                        <option value="logout"
                            @selected(request('action') === 'logout')>
                            Logout
                        </option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5
                               text-sm font-semibold text-white
                               hover:bg-blue-700">
                        Cari
                    </button>

                    <a href="{{ route('admin.activity-log.index') }}"
                        class="rounded-lg border border-gray-300 px-5 py-2.5
                               text-sm font-semibold text-gray-700
                               hover:bg-gray-50">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold
                                       uppercase tracking-wider text-gray-500">
                                Waktu
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold
                                       uppercase tracking-wider text-gray-500">
                                Pengguna
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold
                                       uppercase tracking-wider text-gray-500">
                                Aktivitas
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold
                                       uppercase tracking-wider text-gray-500">
                                Alamat IP
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($activities as $activity)
                            <tr class="hover:bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $activity->created_at?->format('d-m-Y H:i:s') }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $activity->user?->name ?? 'Pengguna tidak tersedia' }}
                                    </div>
                                    @if ($activity->user?->email)
                                        <div class="mt-1 text-xs text-gray-500">
                                            {{ $activity->user->email }}
                                        </div>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($activity->action === 'login')
                                        <span class="inline-flex rounded-full bg-green-100
                                                     px-3 py-1 text-xs font-semibold text-green-700">
                                            LOGIN
                                        </span>
                                    @elseif ($activity->action === 'logout')
                                        <span class="inline-flex rounded-full bg-gray-100
                                                     px-3 py-1 text-xs font-semibold text-gray-700">
                                            LOGOUT
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-blue-100
                                                     px-3 py-1 text-xs font-semibold text-blue-700">
                                            {{ strtoupper($activity->action) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $activity->ip_address ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-6 py-10 text-center text-sm text-gray-500">
                                    Belum ada aktivitas yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-gray-200 px-6 py-4">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
