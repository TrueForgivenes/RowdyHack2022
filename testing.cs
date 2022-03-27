using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;

public class testing : MonoBehaviour
{
    string url = "http://localhost/rh2022/register.php";
    
    // Start is called before the first frame update
    void Start()
    {
        Debug.Log("HEY!");
        //Use these to call database throught the php file in the url above
        //StartCoroutine(createTable());
        //StartCoroutine(createAccount());  
        //StartCoroutine(logIn());
        //StartCoroutine(setModelcode());
        //StartCoroutine(getModelcode());
    }

    IEnumerator createTable(){

        List<IMultipartFormSection> wwwForm = new List<IMultipartFormSection>();
        wwwForm.Add(new MultipartFormDataSection("request", "0"));
        UnityWebRequest www = UnityWebRequest.Post(url,wwwForm);

        yield return www.SendWebRequest();


        if( www.isHttpError){
            Debug.Log(www.error);
        }
        else if(www.isNetworkError){
            Debug.Log(www.error);
        }
        else{
            Debug.Log("we gucci");
        }

    }

    IEnumerator createAccount(){

        List<IMultipartFormSection> wwwForm = new List<IMultipartFormSection>();

        wwwForm.Add(new MultipartFormDataSection("username", "Jacob"));
        wwwForm.Add(new MultipartFormDataSection("password", "rh2022Jacob"));
        wwwForm.Add(new MultipartFormDataSection("request", "1"));
        UnityWebRequest www = UnityWebRequest.Post(url,wwwForm);

        yield return www.SendWebRequest();

        if(www.isNetworkError || www.isHttpError){
            Debug.Log("www.error");
        }
        else{
            Debug.Log("we gucci");
        }
    }
    IEnumerator logIn(){

        List<IMultipartFormSection> wwwForm = new List<IMultipartFormSection>();
        wwwForm.Add(new MultipartFormDataSection("request", "2"));
        wwwForm.Add(new MultipartFormDataSection("username", "Jio"));
        wwwForm.Add(new MultipartFormDataSection("password", "rh2022Joe"));
        UnityWebRequest www = UnityWebRequest.Post(url,wwwForm);
        yield return www.SendWebRequest();

        if(www.isNetworkError || www.isHttpError){
            Debug.Log("www.error");
        }
        else{
            Debug.Log("we gucci");
            Debug.Log(www.downloadHandler.text);
        }
    }
    IEnumerator setModelcode(){

        List<IMultipartFormSection> wwwForm = new List<IMultipartFormSection>();
        wwwForm.Add(new MultipartFormDataSection("request", "3"));
        wwwForm.Add(new MultipartFormDataSection("username", "Jacob"));
        wwwForm.Add(new MultipartFormDataSection("modelCode", "KDI8MNL"));
        UnityWebRequest www = UnityWebRequest.Post(url,wwwForm);
        yield return www.SendWebRequest();

        if(www.isNetworkError || www.isHttpError){
            Debug.Log("www.error");
        }
        else{
            Debug.Log("we gucci");
        }
    }
    IEnumerator getModelcode(){

        List<IMultipartFormSection> wwwForm = new List<IMultipartFormSection>();
        wwwForm.Add(new MultipartFormDataSection("request", "4"));
        wwwForm.Add(new MultipartFormDataSection("username", "Jio"));
        UnityWebRequest www = UnityWebRequest.Post(url,wwwForm);
        yield return www.SendWebRequest();

        if(www.isNetworkError || www.isHttpError){
            Debug.Log("www.error");
        }
        else{
            Debug.Log("we gucci");

            Debug.Log(www.downloadHandler.text);
        }
    }
}
