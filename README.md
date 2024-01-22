## Start project

The task was completed using the standard Laravel Sail tool.

To run the project you need to run the console command:

```bash
sail up -d
sail php artisan migrate --seeds
```

To start automatically updating information about banks, their branches and current exchange rates, you need to run

```bash
sail php artisan schedule:run
```




