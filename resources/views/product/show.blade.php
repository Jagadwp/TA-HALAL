@extends('../layout/' . $layout)
    
@section('subhead')
    <title>Daftar Bahan Produk</title>
@endsection

@section('subcontent')
    <div id="mover-container" class="mt-5">
        <h2 class="intro-y text-lg font-medium">Daftar Bahan (Produk: <b>{{ $product->name }}</b>)</h2>
        <a class="btn btn-outline-success w-24 inline-block" href="{{ route('product.index') }}" id="back-btn">Kembali</a>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success mt-2" style="display: inline-block;">
        {{ session('success') }}
    </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('ingredient.create', ['product_id'=> $product->id]) }}" class="btn btn-primary inline-block mr-1 mb-2 pr-5"><i data-lucide="plus" class="w-5"></i> Cek Bahan Baru</a>
            <div class="w-full sm:w-auto mt-3 mt-0 ml-auto">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Cari...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">NAMA BAHAN</th>
                        <th class="text-center whitespace-nowrap">STATUS </th>
                        <th class="text-center whitespace-nowrap">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $key => $ingredient)
                        <tr class="intro-x">
                            <td>
                                <p class="font-medium whitespace-nowrap ml-1">{{ $key + 1 }}</p>
                            </td>
                            <td>
                                <p class="font-medium text-center">{{ $ingredient->name }}</p>
                            </td>
                            <td class="w-40">
                                @if ($ingredient->status_halal == 'Halal')
                                <div class="flex items-center justify-center text-success">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ is_null($ingredient->status_halal) ? 'Dalam Proses' : $ingredient->status_halal }}
                                </div>
                                @elseif ($ingredient->status_halal == 'Haram')
                                <div class="flex items-center justify-center text-danger text-bold">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i> {{ is_null($ingredient->status_halal) ? 'Dalam Proses' : $ingredient->status_halal }}
                                </div>
                                @else
                                <div class="flex items-center justify-center text-warning">
                                    <i data-lucide="slack" class="w-4 h-4 mr-2"></i> {{ is_null($ingredient->status_halal) ? 'Dalam Proses' : $ingredient->status_halal }}
                                </div>  
                                @endif
                            </td>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-success mr-5" href="{{ route('ingredient.certificate', ['ingredient_id'=> $ingredient->id]) }}">
                                        <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Cek Bahan
                                    </a>
                                    <a class="flex items-center text-info mr-5" href="{{ route('ingredient.show', ['ingredient_id'=> $ingredient->id]) }}">
                                        <i data-lucide="file-text" class="w-4 h-4 mr-1"></i> Detail
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal-{{ $ingredient->id }}">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- BEGIN: Delete Confirmation Modal -->
                        <div id="delete-confirmation-modal-{{ $ingredient->id }}" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <form action="{{ route('ingredient.destroy', ['ingredient_id'=> $ingredient->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-5 text-center">
                                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                <div class="text-3xl mt-5">Apakah anda yakin?</div>
                                                <div class="text-slate-500 mt-2">Apakah Anda benar-benar ingin menghapus item ini?<br>Proses ini tidak dapat dibatalkan.</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batal</button>
                                                <button type="submit" class="btn btn-danger w-24">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Delete Confirmation Modal -->
                    @endforeach
                </tbody>
            </table>
            <div class="ml-3 mt-6">
                {{ $ingredients->links() }}
            </div>
            @if ($ingredients->total() >= 10)
                <script>
                    const spanElement = document.querySelector('span.relative.z-0.inline-flex.shadow-sm.rounded-md');
                    spanElement.classList.add('ml-4');
                    spanElement.classList.add('-mt-2');
                </script>
            @endif
        </div>
        <!-- END: Data List -->
    </div>
@endsection
