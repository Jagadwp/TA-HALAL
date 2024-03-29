@extends('../layout/' . $layout)

@section('subhead')
    <title>Testing Page</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto main-activity">Testing Page</h2>
    </div>
    <button id="test-btn" class="box border mt-5">TEST NOW</button>
    
    <script>
        const data = {
            "user-id": "0e27b671-82f3-4c93-88d5-2daa37ba6693",
            "ingredient-id": "99543912-658a-4fc1-8366-94eba0896dcc",
            "event-log": [
                {
                    "code": "0baea2eb-2f57-42a0-a79f-88ab4266bd3b",
                    "label": "Mengisi Info Bahan",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:15:35"
                },
                {
                    "code": "2487ba9f-5bbc-469c-9ee4-5c04750e737a",
                    "label": "Cek Sertifikat Halal",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:15:45"
                },
                {
                    "code": "3f6928de-3537-4d70-be6d-ea06f034306d",
                    "label": "Cek Certificate Analysis",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:19:40"
                },
                {
                    "code": "065a3ec6-1c86-47a7-9e5e-c3458ff29a2c",
                    "label": "Cek Kelompok Bahan Hewani",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:49:36"
                },
                {
                    "code": "09e2285d-e566-4f20-9a80-fadc6ad25995",
                    "label": "Cek Bahan Daging dan Turunannya",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:49:36"
                },
                {
                    "code": "41235f50-dfd4-49d6-80dd-e0e7c2392d57",
                    "label": "Cek Daging",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:50:08"
                },
                {
                    "code": "0b67f2e5-5052-41d9-9d06-3574f42719ef",
                    "label": "Cek Warna Daging",
                    "value": "Halal",
                    "timestamp": "2023-06-04 09:50:08"
                },
                {
                    "code": "2dd39525-0ed0-4823-ba14-2a575179b009",
                    "label": "Cek Serat Daging",
                    "value": "Halal",
                    "timestamp": "2023-06-04 09:50:08"
                },
                {
                    "code": "52830040-a9e2-4f42-ab37-04f955a7a510",
                    "label": "Cek Tekstur Daging",
                    "value": "Halal",
                    "timestamp": "2023-06-04 09:50:08"
                },
                {
                    "code": "0fcdd05b-3624-4a89-8809-5a5bc65d228c",
                    "label": "Cek Kehalalan Bahan Hewani",
                    "value": "Halal",
                    "timestamp": "2023-06-04 09:50:17"
                },
                {
                    "code": "f5c7c37b-a977-42a0-954e-9565746440a3",
                    "label": "Cek Lemak",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:43:02"
                },
                {
                    "code": "17c9ed08-bfd8-4589-907c-77d5893c5fe3",
                    "label": "Cek COA DNA Babi pada Lemak",
                    "value": "Halal",
                    "timestamp": "2023-06-04 09:43:02"
                },
                {
                    "code": "fb68ae5f-7522-447f-b1bd-5f36538575b0",
                    "label": "Cek Bahan Susu, Telur, Ikan",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:43:36"
                },
                {
                    "code": "18040202-8134-475a-bc9d-0ebb2e6da1ee",
                    "label": "Cek Penyembelihan",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:54:01"
                },
                {
                    "code": "721a951d-4ed3-40eb-acff-678d80ca8197",
                    "label": "Cek RPH",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:54:01"
                },
                {
                    "code": "8670fc70-e6c0-47e6-9000-d4e02f7cb150",
                    "label": "Cek Pengolahan",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 09:54:32"
                },
                {
                    "code": "afc2c252-3ef2-4466-9422-635c6d415d89",
                    "label": "Cek Bahan Tambahan",
                    "value": "Syubhat",
                    "timestamp": "2023-06-04 10:01:23"
                },
                {
                    "code": "f8dd2036-a004-46b7-95f2-05e3b9d6795f",
                    "label": "Cek Sertifikat Halal Garam",
                    "value": "Halal",
                    "timestamp": "2023-06-04 10:01:23"
                },
                {
                    "code": "7ae58f7b-b194-4592-a5ec-665874f06197",
                    "label": "Cek Informasi Sertifikat Halal Garam",
                    "value": "Halal",
                    "timestamp": "2023-06-04 10:01:23"
                },
                {
                    "code": "2d204877-d640-4a0b-91ec-7c66b4faef6d",
                    "label": "Cek Sertifikat Halal Penyedap Rasa",
                    "value": "Haram",
                    "timestamp": "2023-06-04 10:01:23"
                }
            ]
        }

        const btn = document.querySelector('#test-btn');
        document.getElementById('test-btn').addEventListener('click', async function(e) {
            const modelRoute = 'http://127.0.0.1:5000/get_prediction_result/hewani';
            try {
                const response = await fetch(`${modelRoute}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const res = await response.json();
                console.log('Flask res', res);
            } catch (error) {
                console.error(error);
                throw error;
            }
        })
    </script>
@endsection
