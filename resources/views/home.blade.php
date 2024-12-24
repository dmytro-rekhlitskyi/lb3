<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
<header>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex shrink-0 items-center">
                        <h3 class="text-gray-400">ЛБ-3</h3>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <button data-modal-target="create-user" data-modal-toggle="create-user" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" type="button">
                                Створити юзера
                            </button>
                            <button id="edit-user-modal" data-modal-target="choice-user" data-modal-toggle="choice-user" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" type="button">
                                Редагувати юзера
                            </button>
                            <button id="delete-user-modal"  data-modal-target="choice-user" data-modal-toggle="choice-user" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" type="button">
                                Видалити юзера
                            </button>
                            <button data-modal-target="info-modal" data-modal-toggle="info-modal" id="open-info-modal" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white hidden" type="button">
                            </button>
                            <button data-modal-target="edit-user" data-modal-toggle="edit-user" id="open-edit-user" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white hidden" type="button">
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>
</header>
<main class="container mx-auto px-4">
    <ul role="list" class="divide-y divide-gray-100">
        @foreach($users as $user)
            <li class="flex justify-between gap-x-6 py-5">
                <div class="flex min-w-0 gap-x-4">
                    <img class="size-12 flex-none rounded-full bg-gray-50" src="{{ asset('img/user.png') }}" alt="">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm/6 font-semibold text-gray-900">{{ $user->first_name }}  {{ $user->last_name }}</p>
                        <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm/6 text-gray-900">Nickname: {{ $user->nickname}}</p>
                </div>
            </li>
        @endforeach
    </ul>

    <div id="create-user" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Створення нового юзера
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="create-user">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only" id="close-create-modal">Закрити модальне окно</span>
                    </button>
                </div>
                <form class="p-4 md:p-5" novalidate>
                    <div class="grid gap-4 mb-4 grid-cols-2 ">
                        <div class="col-span-2">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ім'я</label>
                            <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть ім'я користувача" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Прізвище</label>
                            <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть прізвище користувача" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Нікнейм</label>
                            <input type="text" name="nickname" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть нікнейм користувача" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пошта</label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть пошту користувача" required="">
                        </div>
                    </div>
                    <button id="create-user-button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Створити нового юзера
                    </button>

                </form>
            </div>
        </div>
    </div>

    <div id="choice-user" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Список юзерів
                    </h3>
                    <button type="button" id="close-choice-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="choice-user">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Закрити модальне окно</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="select-users" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Юзери</label>
                            <input id="action-user-choice" value="" hidden="hidden">
                            <select id="select-users" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" data-firstname="{{ $user->first_name }}" data-lastname="{{ $user->last_name }}" data-nickname="{{ $user->nickname }}" data-email="{{ $user->email }}">ID: {{ $user->id }} Nickname: {{ $user->nickname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button id="choice-user-button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Вибрати юзера
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-user" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Редагування юзера
                    </h3>
                    <button type="button" id="close-edit-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-user">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Закрити модальне окно</span>
                    </button>
                </div>
                <form class="p-4 md:p-5" novalidate>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <input hidden="hidden" name="id" value="">
                        <div class="col-span-2">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ім'я</label>
                            <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть ім'я користувача" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Прізвище</label>
                            <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть прізвище користувача" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Нікнейм</label>
                            <input type="text" name="nickname" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть нікнейм користувача" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пошта</label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Введіть пошту користувача" required="">
                        </div>
                    </div>
                    <button id="update-user-button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Редагувати юзера
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="info-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Інформація про SQL
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="info-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Закрити модальне вікно</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p id="info-text" class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="close-info-modal" data-modal-hide="info-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Закрити модальне вікно</button>
                </div>
            </div>
        </div>
    </div>

</main>
</body>
<script>
    document.getElementById('create-user').addEventListener('submit', function (event) {
        event.preventDefault();

        const form = event.target;

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const inputs = form.querySelectorAll('input');
        const userData = {};

        inputs.forEach(input => {
            userData[input.name] = input.value;
        });

        fetch('/users/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(userData),
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error(`Помилка: ${response.status}`);
                }
            })
            .then(data => {
                const infoModalButton = document.getElementById('open-info-modal');
                const closeCreateModalButton = document.getElementById('close-create-modal');
                const infoText = document.getElementById('info-text');

                const executedQuery = data.executed_query.query || 'Не доступно';
                const unsafeSqlInjection = data.unsafe_sql_injection || 'Не доступно';

                const message = `
                    <strong>1) Запит без sql інфекціями:</strong> ${executedQuery}<br>
                    <strong>2) Запит з sql інфекціями:</strong> ${unsafeSqlInjection}<br>

                    Тут застосовуються параметризовані запити, в яких дані передаються як окремі аргументи, а не вбудовуються безпосередньо в SQL-код.
                    Це забезпечує захист від виконання небажаних дій, оскільки дані не можуть бути оброблені як SQL-код.
                `;

                infoText.innerHTML = message;

                closeCreateModalButton.click();
                infoModalButton.click();
            })
            .catch(error => {
                alert('Помилка при створенні користувача');
                console.error(error);
            });
    });

    document.getElementById('edit-user-modal').addEventListener('click', function () {
        document.getElementById('action-user-choice').value = 'update';
    });

    document.getElementById('close-info-modal').addEventListener('click', function () {
        window.location.reload();
    });

    document.getElementById('delete-user-modal').addEventListener('click', function () {
        document.getElementById('action-user-choice').value = 'delete';
    });

    document.getElementById('choice-user-button').addEventListener('click', function () {
        let action = document.getElementById('action-user-choice').value;
        if(action === 'update') {
            document.getElementById('open-edit-user').click();
            const selectedOption = document.getElementById('select-users').selectedOptions[0];
            if (selectedOption) {
                const id = selectedOption.value;
                const firstName = selectedOption.dataset.firstname;
                const lastName = selectedOption.dataset.lastname;
                const nickname = selectedOption.dataset.nickname;
                const email = selectedOption.dataset.email;
                document.querySelector('#edit-user input[name="id"]').value = id;
                document.querySelector('#edit-user input[name="first_name"]').value = firstName;
                document.querySelector('#edit-user input[name="last_name"]').value = lastName;
                document.querySelector('#edit-user input[name="nickname"]').value = nickname;
                document.querySelector('#edit-user input[name="email"]').value = email;
            }
        }

        if(action === 'delete'){
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const selectedOption = document.getElementById('select-users').selectedOptions[0];

            fetch('/users/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    'id' : selectedOption.value
                }),
            })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error(`Помилка: ${response.status}`);
                    }
                })
                .then(data => {
                    const infoModalButton = document.getElementById('open-info-modal');
                    const closeChoiceModalButton = document.getElementById('close-choice-modal');
                    const infoText = document.getElementById('info-text');

                    const executedQuery = data.executed_query.query || 'Не доступно';
                    const unsafeSqlInjection = data.unsafe_sql_injection || 'Не доступно';

                    const message = `
                    <strong>1) Запит без sql інфекціями:</strong> ${executedQuery}<br>
                    <strong>2) Запит з sql інфекціями:</strong> ${unsafeSqlInjection}<br>

                    Тут застосовуються параметризовані запити, в яких дані передаються як окремі аргументи, а не вбудовуються безпосередньо в SQL-код.
                    Це забезпечує захист від виконання небажаних дій, оскільки дані не можуть бути оброблені як SQL-код.
                `;

                    infoText.innerHTML = message;

                    closeChoiceModalButton.click();
                    infoModalButton.click();
                })
                .catch(error => {
                    alert('Помилка під час видалення користувача');
                    console.error(error);
                });
        }
    });

    document.getElementById('update-user-button').addEventListener('click', function (event) {
        event.preventDefault();

        const form = document.getElementById('edit-user');

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const inputs = form.querySelectorAll('input');
        const userData = {};

        inputs.forEach(input => {
            userData[input.name] = input.value;
        });

        fetch('/users/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(userData),
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error(`Помилка: ${response.status}`);
                }
            })
            .then(data => {
                const infoModalButton = document.getElementById('open-info-modal');
                const closeEditModalButton = document.getElementById('close-edit-modal');
                const closeChoiceModalButton = document.getElementById('close-choice-modal');
                const infoText = document.getElementById('info-text');

                const executedQuery = data.executed_query.query || 'Не доступно';
                const unsafeSqlInjection = data.unsafe_sql_injection || 'Не доступно';

                const message = `
                    <strong>1) Запит без sql інфекціями:</strong> ${executedQuery}<br>
                    <strong>2) Запит з sql інфекціями:</strong> ${unsafeSqlInjection}<br>

                    Тут застосовуються параметризовані запити, в яких дані передаються як окремі аргументи, а не вбудовуються безпосередньо в SQL-код.
                    Це забезпечує захист від виконання небажаних дій, оскільки дані не можуть бути оброблені як SQL-код.
                `;

                infoText.innerHTML = message;

                closeChoiceModalButton.click();
                closeEditModalButton.click();
                infoModalButton.click();
            })
            .catch(error => {
                alert('Помилка під час оновлення користувача');
                console.error(error);
            });
    });


</script>
</html>
