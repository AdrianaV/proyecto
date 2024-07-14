namespace proyecto.Views;

public partial class inicio : ContentPage
{

	public inicio()
	{
		InitializeComponent();
	}

    private void btnIngresar_Clicked(object sender, EventArgs e)
    {
        String usuario = txtUsuario.Text;

        Navigation.PushAsync(new mapa(usuario));
    }

}