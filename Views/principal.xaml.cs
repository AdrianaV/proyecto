namespace proyecto.Views;

public partial class principal : ContentPage
{
	public principal()
	{
		InitializeComponent();
	}

    private void btnInicio_Clicked(object sender, EventArgs e)
    {
        Navigation.PushAsync(new inicio());
    }

    private void btnRegistrar_Clicked(object sender, EventArgs e)
    {
        Navigation.PushAsync(new registrar());
    }

}