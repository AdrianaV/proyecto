namespace proyecto.Views;

public partial class registrar : ContentPage
{
	public registrar()
	{
		InitializeComponent();
	}

    private void btnRegistrarCliente_Clicked(object sender, EventArgs e)
    {
        Navigation.PushAsync(new registrarCliente());
    }

    private void btnRegistrarUsuario_Clicked(object sender, EventArgs e)
    {
        Navigation.PushAsync(new RegistrarUsuario());
    }
}