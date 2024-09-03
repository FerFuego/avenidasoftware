<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> v{{ env('APP_VERSION', '1.0') }}
    </div>
    <strong>Copyright &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}.</strong> Todos los derechos reservados.
</footer>