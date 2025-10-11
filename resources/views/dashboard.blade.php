<x-app>
    <x-slot:title>Home</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <x-card>
                    <x-card.header>Projects</x-card.header>
                    <x-card.body>
                        here goes a list of your active projects
                    </x-card.body>
                </x-card>
            </div>
            <div class="col-md-auto">
                <x-card>
                    <x-card.header>Tasks</x-card.header>
                    <x-card.body>
                        here goes a list of your active tasks, sorted by due date, importance, status and other sensefull crap
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>
</x-app>
